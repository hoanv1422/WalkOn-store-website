<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    const PATH_VIEW = 'admin.categories.';
    const PATH_UPLOAD = 'categories';


    public function index()
    {
        $categories = Category::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->all();
        $data['is_active'] ??= 0;
        $data['slug'] = Str::slug($data['name']);


        try {
            DB::beginTransaction();

            Category::query()->create($data);

            DB::Commit();
            return redirect()->route('categories.index')->with('success', 'Thêm danh mục thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception);
            return back()->with('error', 'Có lỗi khi thêm');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {

        $data = $request->all();
        $data['is_active'] ??= 0;
        $data['slug'] = Str::slug($data['name']);


        try {
            DB::beginTransaction();

            $category->update($data);

            DB::Commit();
            return redirect()->route('categories.index')->with('success', 'Cập nhật danh mục thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception);
            return back()->with('error', 'Có lỗi khi sửa');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    //123
    public function destroy(Category $category)
    {
        try {
            DB::beginTransaction();


            $category->delete();

            DB::commit();
            return redirect()->route('categories.index')->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            DB::rollback();
            dd($exception);
            return back()->with('error', 'Lỗi');
        }
    }
}
