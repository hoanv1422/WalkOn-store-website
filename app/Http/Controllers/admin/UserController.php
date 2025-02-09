<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    const PATH_VIEW = 'admin.users.';
    const PATH_UPLOAD = 'users';


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        // dd($users);
        return view(self::PATH_VIEW . __FUNCTION__, compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        // dd($request->all());
        $data = $request->except('avatar');
        if ($request->hasFile('avatar')) {
            $data['avatar'] = Storage::put(self::PATH_UPLOAD, $request->file('avatar'));
        } else {
            $data['avatar'] = '';
        }
        $data['is_active'] ??= 0;
        $data['role'] = 'user';


        try {
            DB::beginTransaction();

            User::query()->create($data);

            DB::Commit();
            return redirect()->route('users.index')->with('success', 'Thêm người dùng thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            // DELETE IMAGE in STORAGE

            if (isset($data['avatar'])) {
                Storage::delete($data['avatar']);
            }
            dd($exception);
            return back()->with('error', 'Có lỗi khi thêm người dùng');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // dd($request->all());

        // Data user
        $data = $request->except('avatar');
        if ($request->hasFile('avatar')) {
            $data['avatar'] = Storage::put(self::PATH_UPLOAD, $request->file('avatar'));
            if (!empty($user->avatar) && Storage::exists($user->avatar)) {
                Storage::delete($user->avatar);
            }
        } else {
            $data['avatar'] = $user->avatar;
        }
        $data['is_active'] ??= 0;

        try {
            DB::beginTransaction();
            // Update user 
            $user->update($data);

            DB::Commit();
            return redirect()->route('users.index')->with('success', 'Cập nhật người dùng thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            // DELETE IMAGE in STORAGE

            if (isset($data['avatar'])) {
                Storage::delete($data['avatar']);
            }

            dd($exception);
            return back()->with('error', 'Có lỗi khi cập nhật');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            DB::beginTransaction();


            $user->delete();

            if ($user->avatar) {
                Storage::delete($user->avatar);
            }

            DB::commit();
            return redirect()->route('users.index')->with('success', 'Xóa thành công');

        } catch (\Exception $exception) {
            DB::rollback();
            dd($exception);
            return back()->with('error', 'Lỗi');
        }
    }
}