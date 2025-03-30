<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Category;
use App\Models\Color;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderCancellation;
use App\Models\OrderCancellationReason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Trang thông tin cá nhân
    public function index()
    {
        $user = Auth::user();
        $categories = Category::all();
        $colors = Color::all();
        return view('client.pages.profile.index', compact('user', 'categories', 'colors'));
    }

    // Trang lịch sử đơn hàng
    public function orders(Request $request)
    {
        $user = Auth::user();
        $query = Order::where('user_id', $user->id)
            ->with(['orderItems' => fn($q) => $q->select('id', 'order_id', 'product_name', 'product_sku', 'product_image', 'product_price', 'product_price_sale', 'variant_size_name', 'variant_color_name', 'quantity')])
            ->with('cancellation') // Load thông tin hủy đơn
            ->select('id', 'order_code', 'user_id', 'user_name', 'user_address', 'user_phone', 'receiver_name', 'receiver_address', 'receiver_phone', 'note', 'coupon', 'order_status', 'payment_status', 'payment_method', 'total_price', 'created_at')
            ->orderBy('created_at', 'desc');

        if ($status = $request->query('status')) {
            $query->where('order_status', $status);
        }

        $orders = $query->paginate(15)->appends(['status' => $status]);
        $categories = Category::all();
        $colors = Color::all();
        $cancellationReasons = OrderCancellationReason::all(); // Lấy danh sách lý do hủy

        return view('client.pages.profile.orders', compact('user', 'orders', 'categories', 'colors', 'cancellationReasons'));
    }

    // Cập nhật thông tin cá nhân
    public function update(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Người dùng không tồn tại.'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $updatedFields = [];
        if ($user->name !== $request->input('name')) {
            $user->name = $request->input('name');
            $updatedFields[] = 'Tên người dùng';
        }
        if ($user->phone !== $request->input('phone')) {
            $user->phone = $request->input('phone');
            $updatedFields[] = 'Số điện thoại';
        }
        if ($user->address !== $request->input('address')) {
            $user->address = $request->input('address');
            $updatedFields[] = 'Địa chỉ';
        }
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
            $updatedFields[] = 'Mật khẩu';
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar && $user->avatar !== 'default-avatar.png' && Storage::exists($user->avatar)) {
                Storage::delete($user->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
            $updatedFields[] = 'Ảnh đại diện';
        }

        try {
            $user->save();
            return response()->json([
                'success' => 'Thông tin cá nhân đã được cập nhật.',
                'user' => [
                    'name' => $user->name,
                    'phone' => $user->phone,
                    'address' => $user->address,
                    'avatar' => $user->avatar ? Storage::url($user->avatar) : asset('default-avatar.png'),
                ],
                'updatedFields' => $updatedFields
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Có lỗi xảy ra khi cập nhật thông tin: ' . $e->getMessage()
            ], 500);
        }
    }

    // Hủy đơn hàng
    public function cancelOrder(Request $request, $orderId)
    {
        $order = Order::where('id', $orderId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$order) {
            return response()->json(['error' => 'Đơn hàng không tồn tại hoặc không thuộc về bạn.'], 404);
        }

        if ($order->order_status !== 'pending') {
            return response()->json(['error' => 'Chỉ có thể hủy đơn hàng khi đang ở trạng thái chờ xử lý.'], 403);
        }

        $request->validate([
            'reason' => 'required|string|max:255',
            'custom_reason' => 'nullable|string|max:255|required_if:reason,other',
        ]);

        try {
            DB::beginTransaction();

            $order->order_status = 'cancelled';
            $order->save();

            // Kiểm tra lý do hủy và lưu vào bảng order_cancellations
            $reason = $request->input('reason');
            $reasonId = null;
            $customReason = null;

            if ($reason === 'other') {
                $customReason = $request->input('custom_reason');
            } else {
                $reasonRecord = OrderCancellationReason::where('reason', $reason)->first();
                if ($reasonRecord) {
                    $reasonId = $reasonRecord->id;
                }
            }

            OrderCancellation::create([
                'order_id' => $order->id,
                'reason_id' => $reasonId,
                'custom_reason' => $customReason,
                'cancelled_by_id' => Auth::id(),
                'cancelled_at' => now(),
            ]);

            // Hoàn lại số lượng sản phẩm trong kho
            foreach ($order->orderItems as $item) {
                if ($item->product_variant_id) {
                    $variant = \App\Models\ProductVariant::find($item->product_variant_id);
                    if ($variant) {
                        $variant->increment('quantity', $item->quantity);
                        $variant->product->increment('quantity', $item->quantity);
                    }
                }
            }

            DB::commit();
            return response()->json(['success' => "Đơn hàng #{$order->order_code} đã được hủy."]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()], 500);
        }
    }

    public function createAddress(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();

        $data['user_id'] = $user->id;
        $data['city'] = $request->province_name;
        $data['district'] = $request->district_name;
        $data['ward'] = $request->ward_name;
        $data['address_line'] = $request->address_line;
        $data['type'] = $request->addressType;
        $data['latitude'] = $request->latitude;
        $data['longitude'] = $request->longitude;
        $data['is_default'] = $request->has('default_address') ? 1 : 0;

        try {
            DB::beginTransaction();

            if ($data['is_default'] == 1) {
                Address::where('user_id', $user->id)->update(['is_default' => 0]);
            }

            Address::create($data);

            DB::commit();
            return back()->with('success', 'Thêm địa chỉ thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi khi thêm');
        }
    }
}
