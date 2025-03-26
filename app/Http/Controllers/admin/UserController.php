<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
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

        $title = "Người Dùng";
        $users = User::all();
        $validateUser = User::select('id', 'email', 'username')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('users', 'validateUser', 'title'));
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
        $data = $request->all();

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('users', 'public');
            $data['avatar'] = $path;
            if (!empty($user->avatar) && Storage::exists('public/'.$user->avatar)) {
                Storage::delete('public/'.$user->avatar);
            }
        }
        if (!$request->has('is_active')) {
            $data['is_active'] = $user->is_active;
        }
        if (Auth::user()->id == $user->id && isset($data['is_active']) && $data['is_active'] == 0) {
            return back()->with('error', 'Bạn không thể tự khóa tài khoản quản trị của mình');
        }
        if (Auth::user()->id == $user->id && isset($data['role']) && $data['role'] != Auth::user()->role) {
            return back()->with('error', 'Bạn không thể tự thay đổi vai trò của mình khi làm admin ');
        }

        try {
            DB::beginTransaction();
            $user->update($data);
            DB::commit();
            return redirect()->route('users.index')->with('success', 'Cập nhật người dùng thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            if (isset($data['avatar'])) {
                Storage::delete($data['avatar']);
            }
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

    public function filterUsers(Request $request)
    {
        $query = User::query();

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%$keyword%")
                    ->orWhere('email', 'LIKE', "%$keyword%")
                    ->orWhere('phone', 'LIKE', "%$keyword%");
            });
        }

        if ($request->filled('date_range')) {
            $dates = preg_split('/\s(to|-)\s/', $request->input('date_range'));

            if (count($dates) == 2) {
                try {
                    $start_date = \Carbon\Carbon::createFromFormat('d/m/Y', trim($dates[0]))->startOfDay();
                    $end_date = \Carbon\Carbon::createFromFormat('d/m/Y', trim($dates[1]))->endOfDay();

                    $query->whereBetween('created_at', [$start_date, $end_date]);
                } catch (\Exception $e) {
                    return back()->with('error', 'Định dạng ngày không hợp lệ!');
                }
            }
        }


        if ($request->filled('status') && $request->input('status') != 'all') {
            $query->where('is_active', $request->input('status') == 'Active' ? 1 : 0);
        }

        $users = $query->get();

        $title = "Người Dùng";
        return view(self::PATH_VIEW . 'index', compact('users', 'title'));
    }
}
