<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
            'mail' => 'nullable|email|unique:users,mail|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:500',
            'role' => 'required|string|max:50',
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

            // $this->GenerateUserImage($image, $file_name);

            $user->avatar = $file_name;
        }

        $user->save();

        return redirect()->route('admin.users')->with('status', 'Add user success');
    }

    // public function GenerateUserImage($image, $imageName)
    // {
    //     $destinationPath = public_path('users/');
    //     $img = Image::make($image->path());
    //     $img->fit(124, 124, function ($constraint) {
    //         $constraint->upsize();
    //     });
    //     $img->save($destinationPath . '/' . $imageName);
    // }
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
            $image = $request->file('avatar');
            $file_extention = $image->extension();
            $file_name = Carbon::now()->timestamp . '.' . $file_extention;

            // $this->GenerateUserImage($image, $file_name);

            $user->avatar = $file_name;
        }

        $user->save();

        return redirect()->route('admin.users')->with('status', 'Edit user success');
    }
}
