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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $postCategories = PostCategories::all();
        $postCategorySlug = PostCategories::select('id', 'slug')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('postCategories', 'postCategorySlug'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        $data['is_active'] ??= 0;
        $data['slug'] = Str::slug($data['name']);

        try {
            DB::beginTransaction();

            PostCategories::query()->create($data);

            DB::commit();
            return redirect()->route('post-categories.index')->with('success', 'Thêm danh mục bài viết thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi khi thêm danh mục bài viết');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(PostCategories $postCategories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PostCategories $postCategories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
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
            return redirect()->route('post-categories.index')->with('success', 'Cập nhật danh mục thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            // Ghi log lỗi hoặc dd($exception) nếu cần
            return back()->with('error', 'Có lỗi khi sửa');
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostCategories $post_category)
    {
        try {
            DB::beginTransaction();
            $post_category->delete();
            DB::commit();
            return redirect()->route('post-categories.index')->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            DB::rollback();
            // Ghi log lỗi hoặc xử lý theo cách thích hợp
            return back()->with('error', 'Lỗi');
        }
    }
}
