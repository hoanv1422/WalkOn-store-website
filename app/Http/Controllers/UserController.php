<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class UserController extends Controller
{

    public function users()
    {
        $users = User::orderBy('id', 'DESC')->paginate(10);
        return view('admin.users.index', compact('users'));
    }
    public function create_user()
    {
        return view('admin.users.create');
    }
    public function delete_user($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin.users')->with('status', 'Delete user success');
    }

    public function add_user(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username|max:255',
            'password' => 'required|string|min:6',
            'name' => 'required|string|max:255',
            'mail' => 'email|unique:users,mail|max:255',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'string|max:15',
            'address' => 'string|max:500',
            'role' => 'required|string|in:user,admin|max:50',
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->password = $request->password;
        $user->name = $request->name;
        $user->mail = $request->mail;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = $request->role;
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $file_extention = $image->extension();
            $file_name = Carbon::now()->timestamp . '.' . $file_extention;

            $path = $image->storeAs('public/users', $file_name);
            $user->avatar = 'users/' . $file_name;
        }

        $user->save();

        return redirect()->route('admin.users')->with('status', 'Add user success');
    }

    public function edit_user($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update_user(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username|max:255',
            'password' => 'required|string|min:6',
            'name' => 'required|string|max:255',
            'mail' => 'nullable|email|unique:users,mail|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:500',
            'role' => 'required|string|max:50',
        ]);

        $user = User::find($request->id);
        $user->username = $request->username;
        $user->password = $request->password;
        $user->name = $request->name;
        $user->mail = $request->mail;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = $request->role;
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::delete('public/' . $user->avatar);
            }

            $image = $request->file('avatar');
            $file_name = Carbon::now()->timestamp . '.' . $image->extension();
            $path = $image->storePubliclyAs('users', $file_name, 'public');
            
            $user->avatar = 'users/' . $file_name;
        }

        $user->save();

        return redirect()->route('admin.users')->with('status', 'Edit user success');
    }

    public function detail_user($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin.users')->with('error', 'Người dùng chưa có');
        }
        return view('admin.users.detail', compact('user'));
    }
}
