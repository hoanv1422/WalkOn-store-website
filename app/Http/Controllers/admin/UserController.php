<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
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