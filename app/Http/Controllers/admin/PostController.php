<?php

namespace App\Http\Controllers\admin;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PostCategories;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    const PATH_VIEW = 'admin.posts.';
    const PATH_UPLOAD = 'posts';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = Post::with('category')->get();
        $postSlugs = Post::select('id', 'slug')->get();
        $categories = PostCategories::select('id', 'name')->get();
        return view(self::PATH_VIEW . 'index', compact('posts', 'postSlugs', 'categories'));
        
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
                // Validate dữ liệu đầu vào
                $validated = $request->validate([
                    'title'       => 'required|max:100',
                    'content'     => 'required',
                    'category_id' => 'required|exists:post_categories,id',
                    'is_active'   => 'required|boolean',
                    'thumbnail'   => 'nullable|image|max:2048',
                ]);
        
                DB::beginTransaction();
                try {
                    // Tạo slug từ tiêu đề
                    $validated['slug'] = Str::slug($validated['title']);
        
                    // Xử lý file upload nếu có
                    if ($request->hasFile('thumbnail')) {
                        $file = $request->file('thumbnail');
                        $filename = time() . '_' . $file->getClientOriginalName();
                        $file->move(public_path('uploads/' . self::PATH_UPLOAD), $filename);
                        $validated['thumbnail'] = $filename;
                    }
        
                    // Gán user_id (nếu người dùng chưa đăng nhập, bạn có thể thiết lập mặc định)
                    $validated['user_id'] = auth()->id() ?? 1;
        
                    // Xác định trạng thái dựa trên trường is_active: nếu is_active == 1 thì status là published, ngược lại là draft
                    $validated['status'] = $validated['is_active'] ? 'published' : 'draft';
        
                    Post::create($validated);
        
                    DB::commit();
                    return redirect()->route('posts.index')->with('success', 'Thêm bài viết thành công');
                } catch (\Exception $ex) {
                    DB::rollBack();
                    return back()->with('error', 'Có lỗi khi thêm bài viết: ' . $ex->getMessage());
                }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
        $validatedData = $request->validate([
            'title'       => 'required|max:100',
            'content'     => 'required',
            'category_id' => 'required|exists:post_categories,id',
            'thumbnail'   => 'nullable|image|max:2048',
            'status'      => 'required|in:published,draft,pending',
        ]);

        $slug = Str::slug($validatedData['title']);

        // Kiểm tra slug có bị trùng với bài viết khác không
        if (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['title' => 'Tiêu đề đã tồn tại.']);
        }

        // Xử lý upload ảnh nếu có
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/' . self::PATH_UPLOAD), $filename);
            $validatedData['thumbnail'] = $filename;
        }

        $validatedData['slug'] = $slug;
        // Cập nhật bài viết
        $post->update($validatedData);

        return redirect()->route('posts.index')
            ->with('success', 'Bài viết đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
          // Nếu có ảnh đại diện, xóa file ảnh (nếu cần)
          if ($post->thumbnail && file_exists(public_path('uploads/' . self::PATH_UPLOAD . '/' . $post->thumbnail))) {
            unlink(public_path('uploads/' . self::PATH_UPLOAD . '/' . $post->thumbnail));
        }

        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Bài viết đã được xóa thành công.');
    }
    
}
