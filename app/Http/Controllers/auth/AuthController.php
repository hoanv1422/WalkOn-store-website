<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\alert;

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
        return redirect()->route('login')->with('success', 'Đăng ký người dùng success');
    }
    //đăng nhập
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->is_active == 0) {
                Auth::logout();
                return back()->with('status', 'Tài khoản của bạn đã bị khóa ');
            }
            if ($user->role === 'admin') {
                return redirect()->route('admin.index')->with('success', 'Đăng nhập thành công!');
            } else {
                return redirect('/')->with('success', 'Đăng nhập thành công!');
            }
        } else {
            return back()->with('status', 'Sai mật khẩu hoặc tên tài khoản');
        }
    }

    // đăng xuất
    public function logout()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('status', 'Bạn cần đăng nhập trước khi đăng xuất tài khoản');
        }
        Auth::logout();
        return redirect()->route('login')->with('success', 'Đã đăng xuất khỏi tài khoản ');
    }


    public function signinAdmin(Request $request)
    {
        // dd($request->all());
        if (Auth::attempt(['mail' => $request->mail, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.index');
            } else {
                return 1;
            }
        } else {
            return back()->with('error', 'Sai mật khẩu hoặc tên tài khoản');
        }
    }

}
