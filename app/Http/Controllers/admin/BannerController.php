<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
   // Hiển thị danh sách banner trong Admin
   public function index()
   {
       $banners = Banner::orderBy('position')->get();
       return view('admin.banners.index', compact('banners'));
   }

   
   // Lưu banner mới vào database
   public function store(Request $request)
   {
       $request->validate([
           'title' => 'nullable|string|max:255',
           'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
           'link' => 'nullable|url',
           'position' => 'required|integer|unique:banners,position',
       ]);
   
       $imagePath = $request->file('image')->store('banners', 'public');
   
       Banner::create([
           'title' => $request->title,
           'image_url' => $imagePath,
           'link' => $request->link,
           'position' => $request->position,
       ]);
   
       return response()->json([
           'success' => true,
           'message' => 'Banner đã được thêm thành công!',
       ]);
   }
   

   // chỉnh sửa banner
   public function edit(Banner $banner)
   {
       return view('admin.banners.edit', compact('banner'));
   }

   // Cập nhật banner
   public function update(Request $request, Banner $banner)
{
    $request->validate([
        'title' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'link' => 'nullable|url',
        'position' => 'required|integer|unique:banners,position,' . $banner->id,
    ]);

    if ($request->hasFile('image')) {
        Storage::disk('public')->delete($banner->image_url);
        $imagePath = $request->file('image')->store('banners', 'public');
        $banner->image_url = $imagePath;
    }

    $banner->update([
        'title' => $request->title,
        'link' => $request->link,
        'position' => $request->position,
    ]);

    try {
        $banner->update([
            'title' => $request->title,
            'link' => $request->link,
            'position' => $request->position,
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Banner đã được cập nhật thành công!',
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Cập nhật thất bại! Lỗi: ' . $e->getMessage(),
        ]);
    }
    
}


   // Xóa banner
   public function destroy(Banner $banner)
   {
       Storage::disk('public')->delete($banner->image_url);
       $banner->delete();
       
       return redirect()->route('admin.banners.index')->with('success', 'Banner đã được xóa!');
   }
}
