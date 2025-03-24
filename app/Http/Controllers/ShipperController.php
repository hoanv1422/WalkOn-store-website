<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShipperController extends Controller
{
    public function index()
    {
        return view('shipper.dashboard');
    }
    public function logout(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('status', 'Bạn cần đăng nhập trước khi đăng xuất tài khoản');
        }
        Auth::logout();
        if ($request) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return redirect()->route('login')->with('success', 'Đã đăng xuất khỏi tài khoản');
    }

}
