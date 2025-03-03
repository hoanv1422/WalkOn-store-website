<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->with('orderItems')->get();
        $categories = Category::all();
        $colors = Color::all();

        return view('client.pages.profile.my-account', compact('user', 'orders', 'categories', 'colors'));
    }

    public function show()
    {
        $user = Auth::user();
        $categories = Category::all();
        $colors = Color::all();

        return view('client.pages.profile.index', compact('user', 'categories', 'colors'));
    }

    // public function update(Request $request)
    // {
    //     $user = Auth::user();

    //     // Xác thực dữ liệu đầu vào
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'phone' => 'nullable|string|max:15',
    //         'address' => 'nullable|string|max:255',
    //         'password' => 'nullable|string|min:8|confirmed',
    //     ]);

    //     // Cập nhật thông tin người dùng
    //     $user->name = $request->input('name');
    //     $user->phone = $request->input('phone');
    //     $user->address = $request->input('address');

    //     // Cập nhật mật khẩu nếu có
    //     if ($request->filled('password')) {
    //         $user->password = Hash::make($request->input('password'));
    //     }

    //     // Lưu thông tin người dùng
    //     try {
    //         $user->save();
    //         return redirect()->back()->with('success', 'Thông tin cá nhân đã được cập nhật.');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật thông tin cá nhân.');
    //     }
    // }
}
