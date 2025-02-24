<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Str;
use App\Models\PostComments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PostCommentController extends Controller
{
    const PATH_VIEW = 'admin.post-comments.';
    const PATH_UPLOAD = 'post-comments';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $postComments = PostComments::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('postComments', ));
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

            PostComments::query()->create($data);

            DB::commit();
            return redirect()->route('post-comments.index')->with('success', 'Thêm danh mục bài viết thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi khi thêm danh mục bài viết');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PostComments $postComments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PostComments $postComments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PostComments $post_comment)
    {
        //
      // Lấy dữ liệu từ request, loại trừ _token và _method
    $data = $request->except(['_token', '_method']);
    // Lấy trạng thái bình luận từ request, mặc định là 'pending'
    $data['status'] = $request->input('status', 'pending');
    
    //  xử lý nội dung (ví dụ: trim, kiểm tra độ dài,...)
    // $data['content'] = trim($data['content']);

    try {
        DB::beginTransaction();
        $post_comment->update($data);
        DB::commit();
        return redirect()->route('post-comments.index')->with('success', 'Cập nhật bình luận thành công');
    } catch (\Exception $exception) {
        DB::rollBack();
        // Ghi log lỗi : Log::error($exception);
        return back()->with('error', 'Có lỗi khi cập nhật bình luận');
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostComments $post_comment)
    {
        //
        try {
            DB::beginTransaction();
            $post_comment->delete();
            DB::commit();
            return redirect()->route('post-comments.index')->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            DB::rollback();
            // Ghi log lỗi hoặc xử lý theo cách thích hợp
            return back()->with('error', 'Lỗi');
        }
    }
}
