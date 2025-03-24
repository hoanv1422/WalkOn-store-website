<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Category;
use App\Models\Color;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->with('orderItems')->orderBy('created_at', 'desc')->get();
        $categories = Category::all();
        $colors = Color::all();

        return view('client.pages.profile.index', compact('user', 'orders', 'categories', 'colors'));
    }

    public function show()
    {
        $user = Auth::user();
        $categories = Category::all();
        $colors = Color::all();

        return view('client.pages.profile.index', compact('user', 'categories', 'colors'));
    }

    // Phương thức để cập nhật thông tin người dùng
    public function update(Request $request)
    {
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        // Kiểm tra xem $user có phải là instance của model User không
        if (!$user) {
            return redirect()->back()->with('error', 'Người dùng không tồn tại.');
        }

        // Xác thực dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Cập nhật thông tin người dùng
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

        // Lưu thông tin người dùng
        try {
            $user->save();
            // dd(get_class($user));
            return redirect()->back()->with('success', 'Thông tin cá nhân đã được cập nhật.')->with('updatedFields', $updatedFields);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật thông tin cá nhân.');
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
