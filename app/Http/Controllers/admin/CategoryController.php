<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories= Category::all();
        // dd($categories);
        return view('admin.categories.index',compact('categories'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
          
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        // $request->validate([
        // 'name' => 'required|string|max:255',
        // 'isActivate'=> 'requierd|boolean'
        // ]);
        // dd($request->all());
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) ,
            'is_active' => $request->isActivate,
        ]);
        
        return redirect()->route('categories.index')->with('success', 'Danh mục đã được thêm thành công!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'isActivate' => 'required|boolean',
        // ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name) ,
            'is_active' => $request->isActivate,
        ]);

        return redirect()->route('categories.index')->with('success', 'Cập nhật danh mục thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Xóa danh mục thành công!');

    }
}
