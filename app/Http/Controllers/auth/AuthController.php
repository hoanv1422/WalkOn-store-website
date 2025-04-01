<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use function Laravel\Prompts\alert;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username|max:255',
            'password' => 'required|string|min:6|confirmed',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email|max:255',
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'user'
        ]);

        Auth::login($user);
        return redirect()->route('login')->with('success', 'Đăng ký người dùng thành công');
    }

    //đăng nhập
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = ['email' => $request->email, 'password' => $request->password];
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->is_active == 0) {
                Auth::logout();
                return back()->with('status', 'Tài khoản của bạn đã bị khóa.');
            }
            if (!$user->hasVerifiedEmail()) {
                return redirect()->route('verification.notice')->with('status', 'Bạn cần xác thực email trước khi sử dụng hệ thống.');
            }
            return match ($user->role) {
                'admin' => redirect('/admin'),
                'shipper' => redirect('/shipper'),
                default => redirect('/'),
            };
        }

        return back()->with('status', 'Sai mật khẩu hoặc tên tài khoản');
    }


    // đăng xuất
    public function logout(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('status', 'Bạn cần đăng nhập trước khi đăng xuất tài khoản');
        }
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function signinAdmin(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
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


    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $status = Password::sendResetLink($request->only('email'), function ($user, $token) {
            Mail::to($user->email)->send(new ResetPasswordMail($token, $user->email));
        });

        if ($status === Password::RESET_LINK_SENT) {
            session(['password_reset_requested' => true]);
            return redirect()->route('confirmation.password');
        }

        return back()->withErrors(['email' => 'Không thể gửi email. Vui lòng thử lại sau.']);
    }


    public function showResetForm($token)
    {
        return view('auth.reset_password', ['token' => $token]);
    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);
        $tokenData = DB::table('password_reset_tokens')->where('email', $request->email)
            ->where('created_at', '>=', now()->subMinutes(60))->first();

        if (!$tokenData || !Hash::check($request->token, $tokenData->token)) {
            return back()->withErrors(['token' => 'Token không hợp lệ hoặc đã hết hạn.']);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Không tìm thấy tài khoản tương ứng.']);
        }
        $user->update([
            'password' => Hash::make($request->password)
        ]);
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        Auth::logout();
        return redirect()->route('login')->with('success', 'Mật khẩu đã được cập nhật');
    }

    // xác thực email
    public function sendVerificationEmail(Request $request): RedirectResponse
    {
        if (!$request->user()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xác thực email.');
        }
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('verified.email')->with('message', 'Email đã được xác thực trước đó.');
        }
        $request->user()->sendEmailVerificationNotification();
        session(['email_verification_sent' => true]);

        return redirect()->route('email.sent')->with('message', 'Email xác thực đã được gửi!');
    }
}
