<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PostCategories;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PostCategoryController extends Controller
{
    const PATH_VIEW = 'admin.post-categories.';
    const PATH_UPLOAD = 'post-categories';

 

    public function index()
    {
        $postCategories = PostCategories::all();
        $postCategorySlug = PostCategories::select('id', 'slug')->get();
        return view(self::PATH_VIEW . 'index', compact('postCategories', 'postCategorySlug'));
    }

    /**
     * Lưu danh mục mới.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['is_active'] = $request->input('is_active', 0);
        $data['slug'] = Str::slug($data['name']);

        try {
            DB::beginTransaction();
            PostCategories::query()->create($data);
            DB::commit();
            return redirect()->route('post-categories.index')
                ->with('success', 'Thêm danh mục bài viết thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi khi thêm danh mục bài viết');
        }
    }

    /**
     * Cập nhật danh mục.
     */
    public function update(Request $request, PostCategories $post_category)
    {
        $data = $request->except(['_token', '_method']);
        $data['is_active'] = $request->input('is_active', 0);
        $data['slug'] = Str::slug($data['name']);

        try {
            DB::beginTransaction();
            $post_category->update($data);
            DB::commit();
            return redirect()->route('post-categories.index')
                ->with('success', 'Cập nhật danh mục thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi khi cập nhật danh mục');
        }
    }

    /**
     * Xóa danh mục.
     */
    public function destroy(PostCategories $post_category)
    {
        try {
            DB::beginTransaction();
            $post_category->delete();
            DB::commit();
            return redirect()->route('post-categories.index')
                ->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', 'Lỗi');
        }
    }

    /**
     * Lọc danh mục theo từ khóa, trạng thái và khoảng ngày.
     */
    public function filter(Request $request)
    {
        $query = PostCategories::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status') && $request->status !== 'all') {
            if ($request->status === 'Active') {
                $query->where('is_active', 1);
            } elseif ($request->status === 'Block') {
                $query->where('is_active', 0);
            }
        }

        if ($request->filled('date')) {
            $dates = explode(' - ', $request->date);
            if (count($dates) === 2) {
                $start = date('Y-m-d', strtotime($dates[0]));
                $end = date('Y-m-d', strtotime($dates[1]));
                $query->whereBetween('created_at', [$start, $end]);
            }
        }

        $postCategories = $query->get();
        $html = view(self::PATH_VIEW . 'table-rows', compact('postCategories'))->render();

        return response()->json([
            'success' => true,
            'html' => $html
        ]);
    }
}
