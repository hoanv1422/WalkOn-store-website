<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username|max:255',
            'password' => 'required|string|min:6',
            'name' => 'required|string|max:255',
            'mail' => 'nullable|email|unique:users,mail|max:255',
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'mail' => $request->mail,
            'role' => 'user'
        ]);

        Auth::login($user);
        return redirect()->route('login')->with('status', 'Đăng ký người dùng success');
    }
    //đăng nhập
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username|max:255',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.index');
            } else {
                return redirect('/');
            }
        } else {
            return back()->with('status', 'Sai mật khẩu hoặc tên tài khoản');
        }
    }

    // đăng xuất
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login')->with('status', 'Đã đăng xuất khỏi tài khoản ');
    }
}
