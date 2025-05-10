<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\website_information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FooterController extends Controller
{
    public function index(){
        $info=website_information::first();
        return view('admin.footers.index',compact('info'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'email' => 'required|email|unique:website_informations,email,' . $id,
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            
        ]);
    
        $website = website_information::findOrFail($id);
    
        // Cập nhật logo nếu có
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            // Xóa logo cũ nếu có
            if ($website->logo) {
                Storage::disk('public')->delete($website->logo);
            }
            $website->logo = $logoPath;
        }
    
        // Cập nhật thông tin khác
        $website->site_name = $request->input('site_name');
        $website->email = $request->input('email');
        $website->phone_number = $request->input('phone_number');
        $website->address = $request->input('address');
        $website->description = $request->input('description');
        $website->save();
    
        return redirect()->route('footers.index')->with('success', 'Thông tin website đã được cập nhật');
    }
    
 
}