<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $admin = Auth::user();
        return view('admin.profile.index', compact('admin'));
    }
    public function edit()
    {
        $admin = Auth::user();
        return view('admin.profile.edit', compact('admin'));
    }
    public function update(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:10',
            'address' => 'required|string|max:255',
            // 'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $admin->name = $request->name;
        $admin->phone = $request->phone;
        $admin->address = $request->address;

      

        $admin->save();

        return redirect()->route('admin.profile.edit')->with('success', 'Cập nhật thành công!');
    }
    
}
