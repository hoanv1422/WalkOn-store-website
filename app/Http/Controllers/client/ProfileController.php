<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Category;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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


    // Cập nhật thông tin cá nhân
    public function update(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Người dùng không tồn tại.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => ['required','string','min:3', 'max:30'],
            'phone' => [
                'nullable',
                'string',
                'max:15',
                'regex:/^(0|\+84)(3[2-9]|5[689]|7[06-9]|8[1-9]|9[0-9])[0-9]{7}$/'
            ],
            'avatar' => 'nullable|image|max:2048',
        ], [
            'name.required' => 'Tên là bắt buộc.',
            'name.string' => 'Tên phải là chuỗi ký tự.',
            'name.min' => 'Tên không được ngắn hơn 3 ký tự.',
            'name.max' => 'Tên không được dài quá 255 ký tự.',
            'phone.string' => 'Số điện thoại phải là chuỗi ký tự.',
            'phone.max' => 'Số điện thoại không được dài quá 15 ký tự.',
            'phone.regex' => 'Số điện thoại không đúng định dạng. Vui lòng nhập số điện thoại Việt Nam hợp lệ (ví dụ: 0912345678 hoặc +84912345678).',
            'avatar.image' => 'File tải lên phải là hình ảnh (jpg, png, gif, v.v.).',
            'avatar.max' => 'Hình ảnh không được lớn hơn 2MB.',
        ]);

        // Trả về lỗi nếu validate thất bại
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $validator->errors()
            ], 422);
        }

        $updatedFields = [];
        if ($user->name !== $request->input('name')) {
            $user->name = $request->input('name');
            $updatedFields[] = 'Tên người dùng';
        }
        if ($user->phone !== $request->input('phone')) {
            $user->phone = $request->input('phone');
            $updatedFields[] = 'Số điện thoại';
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


    public function addresses()
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json(['error' => 'Unauthenticated'], 401);
            }

            $addresses = $user->addresses()->get()->map(function ($address) {
                return [
                    'id' => $address->id,
                    'city' => $address->city,
                    'city_code' => $address->city_code,
                    'district' => $address->district,
                    'district_code' => $address->district_code,
                    'ward' => $address->ward,
                    'ward_code' => $address->ward_code,
                    'address_line' => $address->address_line,
                    'latitude' => $address->latitude,
                    'longitude' => $address->longitude,
                    'type' => $address->type,
                    'is_default' => $address->is_default,
                    'full_address' => $address->full_address,
                    'type_label' => $address->type_label,
                ];
            });

            return response()->json($addresses, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch addresses'], 500);
        }
    }

    public function createAddressAPI(Request $request)
    {
        $user = Auth::user();


        $validator = Validator::make($request->all(), [
            'province_name' => 'required|string|max:255',
            'city_code' => 'required|string|max:50',
            'district_name' => 'required|string|max:255',
            'district_code' => 'required|string|max:50',
            'ward_name' => 'required|string|max:255',
            'ward_code' => 'required|string|max:50',
            'address_line' => 'required|string|max:500',
            'addressType' => 'required|string|in:HOME,OFFICE,OTHER',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'default_address' => 'nullable|boolean'
        ], [
            // Thông báo lỗi bằng tiếng Việt
            '*.required' => 'Vui lòng nhập đầy đủ thông tin.', // Gộp thông báo required
            'province_name.string' => 'Tên tỉnh/thành phố phải là chuỗi ký tự.',
            'province_name.max' => 'Tên tỉnh/thành phố không được vượt quá 255 ký tự.',
            'city_code.string' => 'Mã tỉnh/thành phố phải là chuỗi ký tự.',
            'city_code.max' => 'Mã tỉnh/thành phố không được vượt quá 50 ký tự.',
            'district_name.string' => 'Tên quận/huyện phải là chuỗi ký tự.',
            'district_name.max' => 'Tên quận/huyện không được vượt quá 255 ký tự.',
            'district_code.string' => 'Mã quận/huyện phải là chuỗi ký tự.',
            'district_code.max' => 'Mã quận/huyện không được vượt quá 50 ký tự.',
            'ward_name.string' => 'Tên phường/xã phải là chuỗi ký tự.',
            'ward_name.max' => 'Tên phường/xã không được vượt quá 255 ký tự.',
            'ward_code.string' => 'Mã phường/xã phải là chuỗi ký tự.',
            'ward_code.max' => 'Mã phường/xã không được vượt quá 50 ký tự.',
            'address_line.string' => 'Địa chỉ chi tiết phải là chuỗi ký tự.',
            'address_line.max' => 'Địa chỉ chi tiết không được vượt quá 500 ký tự.',
            'addressType.in' => 'Loại địa chỉ phải là một trong các giá trị: HOME, OFFICE, OTHER.',
            'latitude.required' => 'Bạn đang nhập quá nhanh.',
            'longitude.reqired' => 'Bạn đang nhập quá nhanh.',
            'latitude.numeric' => 'Vĩ độ phải là một số.',
            'latitude.between' => 'Vĩ độ phải nằm trong khoảng từ -90 đến 90.',
            'longitude.numeric' => 'Kinh độ phải là một số.',
            'longitude.between' => 'Kinh độ phải nằm trong khoảng từ -180 đến 180.',
            'default_address.boolean' => 'Giá trị địa chỉ mặc định phải là boolean.'
        ]);

        // Kiểm tra validation
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Dữ liệu đầu vào không hợp lệ.',
                'errors' => $validator->errors()
            ], 422);
        }

        $data['user_id'] = $user->id;
        $data['city'] = $request->province_name;
        $data['city_code'] = $request->city_code;

        $data['district'] = $request->district_name;
        $data['district_code'] = $request->district_code;

        $data['ward'] = $request->ward_name;
        $data['ward_code'] = $request->ward_code;

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

            $address = Address::create($data);

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Address created successfully',
                'data' => $address
            ], 201);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create address',
                'error' => $exception->getMessage()
            ], 500);
        }
    }


    public function updateAddressAPI(Request $request)
    {
        try {
            $id = $request->address_id;

            if (!Auth::check()) {
                return response()->json(['message' => 'Bạn cần đăng nhập để thực hiện thao tác này.'], 401);
            }

            $address = Address::where('id', $id)
                ->where('user_id', Auth::id())
                ->first();

            if (!$address) {
                return response()->json(['message' => 'Địa chỉ không tồn tại hoặc không thuộc về bạn.'], 404);
            }

            DB::beginTransaction();

            // Update the address fields from the request
            $address->city = $request->province_name;
            $address->city_code = $request->city_code;
            $address->district = $request->district_name;
            $address->district_code = $request->district_code;
            $address->ward = $request->ward_name;
            $address->ward_code = $request->ward_code;
            $address->address_line = $request->address_line;
            $address->type = $request->addressType;
            $address->latitude = $request->latitude;
            $address->longitude = $request->longitude;

            // If this address is set as default
            if ($request->default_address) {
                // Set all other addresses as non-default
                Address::where('user_id', Auth::id())
                    ->where('id', '!=', $id)
                    ->update(['is_default' => false]);

                $address->is_default = true;
            }

            $address->save();

            DB::commit();

            return response()->json([
                'message' => 'Địa chỉ đã được cập nhật thành công!',
                'data' => $address
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error updating address: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'address_id' => $id,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'message' => 'Có lỗi xảy ra khi cập nhật địa chỉ.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function setDefault($id)
    {
        try {
            if (!Auth::check()) {
                return response()->json(['message' => 'Bạn cần đăng nhập để thực hiện thao tác này.'], 401);
            }

            // Tìm địa chỉ
            $address = Address::find($id);
            if (!$address) {
                return response()->json(['message' => 'Địa chỉ không tồn tại.'], 404);
            }
            if ($address->user_id !== Auth::id()) {
                return response()->json(['message' => 'Bạn không có quyền đặt địa chỉ này làm mặc định.'], 403);
            }

            // Giao dịch cơ sở dữ liệu
            DB::beginTransaction();
            Address::where('user_id', Auth::id())
                ->where('is_default', true)
                ->update(['is_default' => false]);
            $address->is_default = true;
            $address->save();
            DB::commit();

            return response()->json([
                'message' => 'Địa chỉ đã được đặt làm mặc định thành công!',
                'data' => $address
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error setting default address: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'address_id' => $id,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'message' => 'Có lỗi xảy ra khi đặt địa chỉ mặc định.'
            ], 500);
        }
    }

    public function deleteAddressAPI($id)
    {
        try {
            // Kiểm tra người dùng đã đăng nhập
            if (!Auth::check()) {
                return response()->json([
                    'message' => 'Bạn cần đăng nhập để thực hiện thao tác này.'
                ], 401);
            }

            // Tìm địa chỉ theo ID và kiểm tra quyền sở hữu
            $address = Address::where('id', $id)
                ->where('user_id', Auth::id())
                ->first();

            if (!$address) {
                return response()->json([
                    'message' => 'Địa chỉ không tồn tại hoặc không thuộc về bạn.'
                ], 404);
            }

            // (Tùy chọn) Kiểm tra nếu địa chỉ là mặc định
            if ($address->default_address) {
                return response()->json([
                    'message' => 'Không thể xóa địa chỉ mặc định. Vui lòng đặt địa chỉ khác làm mặc định trước.'
                ], 400);
            }

            // Xóa địa chỉ
            $address->delete();

            return response()->json([
                'message' => 'Địa chỉ đã được xóa thành công!'
            ], 200);
        } catch (\Exception $e) {
            // Ghi log lỗi để debug
            Log::error('Error deleting address: ' . $e->getMessage(), [
                'user_id' => Auth::id() ?? 'Guest',
                'address_id' => $id,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'message' => 'Có lỗi xảy ra khi xóa địa chỉ.',
                'error' => env('APP_DEBUG', false) ? $e->getMessage() : null
            ], 500);
        }
    }

    public function changePassword(Request $request)
    {
        // Validate dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
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
            'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại.',
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

        // Lấy người dùng hiện tại
        $user = Auth::user();

        // Kiểm tra mật khẩu hiện tại
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Mật khẩu hiện tại không chính xác'
            ], 401);
        }

        // Cập nhật mật khẩu mới
        try {
            $user->password = Hash::make($request->new_password);
            $user->save();

            // Có thể đăng xuất các thiết bị khác (tùy chọn)
            // Auth::logoutOtherDevices($request->new_password);

            return response()->json([
                'status' => 'success',
                'message' => 'Mật khẩu đã được thay đổi thành công'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Đã xảy ra lỗi khi thay đổi mật khẩu',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
