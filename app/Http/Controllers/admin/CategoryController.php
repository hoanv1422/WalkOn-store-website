<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.categories.';
    const PATH_UPLOAD = 'categories';

    public function index(Request $request)
    {
        $query = Category::query();

        // Lọc theo tên
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        // Lọc theo trạng thái
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('is_active', $request->status);
        }

        // Lấy danh sách danh mục với phân trang
        $categories = $query->paginate(10);
        $categorySlug = Category::select('id', 'slug')->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact('categories', 'categorySlug'));
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

            DB::commit();
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

            DB::commit();
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
    public function destroy(Category $category)
    {
        try {
            DB::beginTransaction();

            $category->delete();

            DB::commit();
            return redirect()->route('categories.index')->with('success', 'Xóa danh mục thành công!');
        } catch (QueryException $exception) {
            DB::rollback();

            if ($exception->getCode() == 23000) {
                return back()->with('error', 'Không thể xóa danh mục vì có sản phẩm liên quan.');
            }

            return back()->with('error', 'Có lỗi xảy ra khi xóa danh mục.');
        } catch (\Exception $exception) {
            DB::rollback();
            return back()->with('error', 'Có lỗi không xác định: ' . $exception->getMessage());
        }
    }
}