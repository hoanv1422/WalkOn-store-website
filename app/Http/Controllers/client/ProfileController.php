<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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
    public function orders()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)
            ->with([
                'orderItems' => function ($query) {
                    $query->select(
                        'id',
                        'order_id',
                        'product_name',
                        'product_sku',
                        'product_image',
                        'product_price',
                        'product_price_sale',
                        'variant_size_name',
                        'variant_color_name',
                        'quantity'
                    );
                }
            ])
            ->select(
                'id',
                'order_code',
                'user_id',
                'user_name',
                'user_address',
                'user_phone',
                'receiver_name',
                'receiver_address',
                'receiver_phone',
                'note',
                'coupon',
                'order_status',
                'payment_status',
                'payment_method',
                'total_price',
                'created_at'
            )
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        $categories = Category::all();
        $colors = Color::all();

        return view('client.pages.profile.orders', compact('user', 'orders', 'categories', 'colors'));
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

    // Hủy đơn hàng (đã tối ưu)
    public function cancelOrder(Request $request, $orderId)
    {
        $order = Order::where('id', $orderId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$order) {
            return response()->json(['error' => 'Đơn hàng không tồn tại hoặc không thuộc về bạn.'], 404);
        }

        if (!in_array($order->order_status, ['pending', 'processing'])) {
            return response()->json(['error' => 'Không thể hủy đơn hàng ở trạng thái này.'], 403);
        }

        $request->validate(['cancel_reason' => 'required|string|max:255']);

        try {
            DB::beginTransaction();

            $order->order_status = 'cancelled';
            $order->note = $request->input('cancel_reason');
            $order->save();

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
}
