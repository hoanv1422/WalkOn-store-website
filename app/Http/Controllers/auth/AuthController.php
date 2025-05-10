<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetMailAdmin;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use function Laravel\Prompts\alert;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{


    public function register(Request $request): JsonResponse
    {

        $validator = Validator::make($request->all(), [
            'username' => [
                'required',
                'string',
                'min:5', // Username phải có ít nhất 5 ký tự
                'max:20', // Username tối đa 255 ký tự
                'unique:users,username',
                'regex:/^[\S]+$/', // Đảm bảo username không chứa dấu cách
            ],
            'password' => [
                'required',
                'string',
                'min:8', // Mật khẩu phải có ít nhất 8 ký tự
                'max:20', // Mật khẩu tối đa 20 ký tự
                'regex:/[A-Z]/', // Ít nhất 1 chữ hoa
                'regex:/[0-9]/', // Ít nhất 1 chữ số
                'regex:/[@$!%*?&]/', // Ít nhất 1 ký tự đặc biệt
                'confirmed', // Xác nhận mật khẩu phải khớp
            ],
            'name' => [
                'required',
                'string',
                'min:3', // Tên người dùng phải có ít nhất 3 ký tự
                'max:30', // Tên người dùng tối đa 30 ký tự
            ],
            'email' => [
                'required',
                'email',
                'min:5', // Email phải có ít nhất 5 ký tự
                'max:255', // Email tối đa 255 ký tự
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', // Kiểm tra email hợp lệ
                'unique:users,email',
            ],
        ], [
            // Thông báo tiếng Việt
            'username.required' => 'Vui lòng nhập tên đăng nhập.',
            'username.unique' => 'Tên đăng nhập đã tồn tại.',
            'username.regex' => 'Tên đăng nhập không được chứa dấu cách.',
            'username.min' => 'Tên đăng nhập phải có ít nhất :min ký tự.',
            'username.max' => 'Tên đăng nhập không được vượt quá :max ký tự.',

            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            'password.max' => 'Mật khẩu không được vượt quá :max ký tự.',
            'password.regex' => 'Mật khẩu phải bao gồm ít nhất một chữ cái hoa, một chữ số và một ký tự đặc biệt.',
            'password.confirmed' => 'Mật khẩu và xác nhận mật khẩu không khớp.',

            'name.required' => 'Vui lòng nhập họ tên.',
            'name.min' => 'Họ tên phải có ít nhất :min ký tự.',
            'name.max' => 'Họ tên không được vượt quá :max ký tự.',

            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.min' => 'Email phải có ít nhất :min ký tự.',
            'email.max' => 'Email không được vượt quá :max ký tự.',
            'email.regex' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã được sử dụng.',
        ]);




        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => 'user'
        ]);

        // Auto login + tạo token
        Auth::login($user);
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Đăng ký thành công.',
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'name' => $user->name,
            ],
            'token' => $token,
            'redirect' => '/',
        ]);
    }


    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ]);
        $credentials = ['email' => $request->email, 'password' => $request->password];
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if (!$user->is_active) {
                Auth::logout(); // Đảm bảo không giữ phiên đăng nhập
                return response()->json([
                    'success' => false,
                    'message' => 'Tài khoản của bạn đã bị khóa.'
                ], 403);
            }
            $token = $user->createToken('auth_token')->plainTextToken;
            $verify = !$user->hasVerifiedEmail();
            if ($verify) {
                session(['verify' => true]);
            }
            return response()->json([
                'success' => true,
                'user' => [
                    'id' => $user->id,
                    'email' => $user->email,
                    'role' => $user->role ?? 'user',
                ],
                'token' => $token,
                'verify' => $verify,
                'redirect' => $user->role === 'shipper' ? '/shippers' : '/',
            ], 200);
        }



        return response()->json([
            'success' => false,
            'message' => 'Sai mật khẩu hoặc tên tài khoản'
        ], 401);
    }


    // đăng xuất
    public function logout(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login.form')->with('status', 'Bạn cần đăng nhập trước khi đăng xuất tài khoản');
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $previousUrl = url()->previous();

        // Kiểm tra nếu URL bắt đầu bằng 'admin'
        if (str_contains($previousUrl, '/admin')) {
            return redirect()->route('admin.login.index')->with('success', 'Đăng xuất khỏi tài khoản admin');
        }

        return redirect()->route('login.form')->with('success', 'Đăng xuất khỏi tài khoản');
    }


    public function signinAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lỗi thiếu dữ liệu',
                'errors' => $validator->errors()
            ], 422);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'admin'])) {
            $user = Auth::user();
            if (!$user->is_active) {
                Auth::logout();
                return response()->json([
                    'success' => false,
                    'message' => 'Tài khoản của bạn đã bị khóa.'
                ], 403);
            }

            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'success' => true,
                'user' => [
                    'id' => $user->id,
                    'email' => $user->email,
                    'role' => $user->role,
                ],
                'token' => $token,
                'redirect' => '/admin',
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Sai mật khẩu hoặc tên tài khoản'
        ], 401);
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
        return redirect()->route('login.form')->with('success', 'Mật khẩu đã được cập nhật');
    }

    // xác thực email
    public function sendVerificationEmail(Request $request): RedirectResponse
    {
        if (!$request->user()) {
            return redirect()->route('login.form')->with('error', 'Bạn cần đăng nhập để xác thực email.');
        }
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('verified.email')->with('message', 'Email đã được xác thực trước đó.');
        }
        $request->user()->sendEmailVerificationNotification();
        session(['email_verification_sent' => true]);

        return redirect()->route('email.sent')->with('message', 'Email xác thực đã được gửi!');
    }

    public function clearVerifySession(Request $request)
    {
        session()->forget('verify');
        return response()->json(['success' => true]);
    }



    public function sendResetCode(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => [
                    'required',
                    'email',
                    Rule::exists('users', 'email')->where(function ($query) {
                        $query->where('role', 'admin');
                    }),
                ],
            ], [
                'email.required' => 'Vui lòng nhập địa chỉ email.',
                'email.email' => 'Địa chỉ email không hợp lệ.',
                'email.exists' => 'Email không tồn tại hoặc không phải là tài khoản admin.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $user = User::where('email', $request->email)->first();
            do {
                $code = rand(100000, 999999);
            } while (DB::table('password_reset_tokens')->where('code', $code)->exists());
            $token = Str::random(60);

            // Store reset data
            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $user->email],
                ['email' => $user->email, 'token' => $token, 'code' => $code, 'created_at' => now('Asia/Ho_Chi_Minh')]
            );

            // Send email
            Mail::to($user->email)->send(new PasswordResetMailAdmin($code));

            return response()->json(['message' => 'Reset code sent.', 'token' => $token], 200);
        } catch (\Exception $e) {
            Log::error('Password reset error: ' . $e->getMessage());
            return response()->json(['message' => 'Có lỗi xảy ra: ' . $e->getMessage()], 500);
        }
    }


    public function showConfirmForm($token)
    {
        // Kiểm tra token có tồn tại trong hệ thống không
        $passwordReset = DB::table('password_reset_tokens')
            ->where('token', $token)
            ->first();

        if (!$passwordReset) {
            return redirect()->route('pass-reset.index')
                ->withErrors(['error' => 'Liên kết đặt lại mật khẩu không hợp lệ.']);
        }

        return view('auth.admin.pass-confirm', ['token' => $token]);
    }

    public function confirmResetCode(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'token' => 'required|string',
                'code' => 'required|string|size:6',
            ], [
                'token.required' => 'Token không hợp lệ.',
                'code.required' => 'Vui lòng nhập mã xác nhận.',
                'code.size' => 'Mã xác nhận phải có 6 ký tự.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors(),
                ], 422);
            }

            // Tìm thông tin đặt lại mật khẩu
            $passwordReset = DB::table('password_reset_tokens')
                ->where('token', $request->token)
                ->where('code', $request->code)
                ->where('created_at', '>', now('Asia/Ho_Chi_Minh')->subHours(1))
                ->first();

            if (!$passwordReset) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Mã xác nhận không hợp lệ hoặc đã hết hạn.',
                ], 400);
            }

            $newToken = Str::random(60);

            DB::table('password_reset_tokens')
                ->where('email', $passwordReset->email)
                ->update([
                    'token' => $newToken,
                    'created_at' => now('Asia/Ho_Chi_Minh')
                ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Xác nhận thành công!',
                'token' => $newToken,
                'email' => $passwordReset->email
            ], 200);
        } catch (\Exception $e) {
            Log::error('Confirm code error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Đã xảy ra lỗi: ' . $e->getMessage()
            ], 500);
        }
    }


    public function resendCode(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'token' => 'required|string',
            ], [
                'token.required' => 'Token không hợp lệ.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $reset = DB::table('password_reset_tokens')->where('token', $request->token)->first();

            if (!$reset) {
                return response()->json(['message' => 'Mã không hợp lệ'], 403);
            }

            $resendCount = Cache::get("resend_count:{$request->token}", 0);
            if ($resendCount >= 3) {
                // Sửa lỗi: DB::table()->delete()
                DB::table('password_reset_tokens')->where('token', $request->token)->delete();
                return response()->json(['message' => 'Đã vượt quá số lần gửi mã. Vui lòng thử lại sau.'], 429);
            }

            do {
                $newCode = rand(100000, 999999);
            } while (DB::table('password_reset_tokens')->where('code', $newCode)->exists());

            // Sửa lỗi: DB::table()->update()
            DB::table('password_reset_tokens')
                ->where('token', $request->token)
                ->update([
                    'code' => $newCode,
                    'created_at' => now('Asia/Ho_Chi_Minh')
                ]);

            // Lấy email từ $reset
            $email = $reset->email;

            // Gửi mã qua email
            Mail::to($email)->send(new PasswordResetMailAdmin($newCode));

            Cache::increment("resend_count:{$request->token}");
            Cache::forget("reset_attempts:{$request->token}");

            return response()->json(['message' => 'Mã mới đã được gửi', 'cooldown' => 300]);
        } catch (\Exception $e) {
            Log::error('Resend code error: ' . $e->getMessage());
            return response()->json(['message' => 'Đã xảy ra lỗi: ' . $e->getMessage()], 500);
        }
    }


    public function showChangePasswordForm($token)
    {
        // Kiểm tra token có tồn tại trong hệ thống không
        $passwordReset = DB::table('password_reset_tokens')
            ->where('token', $token)
            ->first();

        if (!$passwordReset) {
            return redirect()->route('pass-reset.index')
                ->withErrors(['error' => 'Liên kết đặt lại mật khẩu không hợp lệ.']);
        }
        return view('auth.admin.pass-change', ['token' => $token]);
    }

    public function changePasswordAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:20',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
                'confirmed',
            ],
        ], [
            'token.required' => 'Token không hợp lệ.',
            'password.required' => 'Vui lòng nhập mật khẩu mới.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            'password.max' => 'Mật khẩu không được vượt quá :max ký tự.',
            'password.regex' => 'Mật khẩu phải bao gồm ít nhất một chữ cái hoa, một chữ số và một ký tự đặc biệt.',
            'password.confirmed' => 'Mật khẩu và xác nhận mật khẩu không khớp.',
        ]);

        // Trả về lỗi nếu validate thất bại
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Tìm thông tin token reset
            $reset = DB::table('password_reset_tokens')->where('token', $request->token)->first();

            if (!$reset) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Token không hợp lệ hoặc đã hết hạn'
                ], 404);
            }

            // Tìm user theo email
            $user = User::where('email', $reset->email)->first();

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Không tìm thấy người dùng'
                ], 404);
            }

            // Cập nhật mật khẩu mới
            $user->password = Hash::make($request->password); // Sử dụng $request->password để đồng nhất với validator
            $user->save();

            // Xóa token sau khi đổi mật khẩu thành công
            DB::table('password_reset_tokens')->where('token', $request->token)->delete();

            // Xóa các cache liên quan nếu có
            Cache::forget("resend_count:{$request->token}");
            Cache::forget("reset_attempts:{$request->token}");

            return response()->json([
                'status' => 'success',
                'message' => 'Mật khẩu đã được thay đổi thành công'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error changing password: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Đã xảy ra lỗi khi thay đổi mật khẩu',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
