<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test() {
        return view('test');
    }

    public function store(Request $request)
    {
        // Validate các trường
        $validated = $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpg|max:2048',
        ]);

        // Kiểm tra nếu có file và lưu tạm thông tin vào session
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            session(['image' => $file->getClientOriginalName()]);
        }

        // Nếu validate thành công, xử lý lưu file
        if ($validated) {
            $file = $request->file('image');
            $file->store('images', 'public');  // Ví dụ lưu vào thư mục 'public/images'

            // Quay lại với thông báo thành công
            return redirect()->back()->with('success', 'File uploaded successfully!');
        }

        // Nếu có lỗi validate, quay lại với lỗi
        return back()->withErrors($validated);
    }

}
