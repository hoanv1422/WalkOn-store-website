<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
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
    public function index(Request $request)
    {
        // Khởi tạo query với các quan hệ
        $query = Post::with('category', 'user');

        // Lọc theo từ khóa tìm kiếm
        if ($request->has('search') && $request->input('search') != '') {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhereHas('category', function ($q) use ($search) {
                      $q->where('name', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->where('name', 'like', '%' . $search . '%');
                  });
            });
        }

        // Lọc theo trạng thái
        $validStatuses = ['published', 'draft', 'pending'];
        if ($request->has('status') && in_array($request->input('status'), $validStatuses)) {
            $query->where('status', $request->input('status'));
        }

        // Lọc theo khoảng ngày
        if ($request->has('start_date') || $request->has('end_date')) {
            $startDate = $request->input('start_date') ? Carbon::createFromFormat('d M, Y', $request->input('start_date'))->startOfDay() : null;
            $endDate = $request->input('end_date') ? Carbon::createFromFormat('d M, Y', $request->input('end_date'))->endOfDay() : null;

            if ($startDate && $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            } elseif ($startDate) {
                $query->where('created_at', '>=', $startDate);
            } elseif ($endDate) {
                $query->where('created_at', '<=', $endDate);
            }
        }

        // Lấy danh sách bài viết với phân trang
        // $posts = $query->paginate(10);
        $posts = $query->get();

        // Nếu là yêu cầu AJAX, trả về HTML của bảng
        if ($request->ajax()) {
            return view('admin.posts.table', compact('posts'))->render();
        }

        // Nếu không, trả về view chính
        $postSlugs = Post::select('id', 'slug')->get();
        $categories = PostCategories::select('id', 'name')->get();
        return view('admin.posts.index', compact('posts', 'postSlugs', 'categories'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Hiển thị form tạo bài viết
        return view(self::PATH_VIEW . 'create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào, thêm rules cho việc upload nhiều ảnh 
        $validated = $request->validate([
            'title'          => 'required|max:100',
            'content'        => 'required',
            'category_id'    => 'required|exists:post_categories,id',
            'is_active'      => 'required|boolean',
            'thumbnail'      => 'nullable|image|max:2048',
            'images_post'    => 'nullable|array',
            'images_post.*'  => 'image|max:2048',
            'captions'       => 'nullable|array',
            'captions.*'     => 'nullable|string',
            'display_orders' => 'nullable|array',
            'display_orders.*' => 'nullable|integer',
        ]);

        DB::beginTransaction();
        try {
            // Tạo slug từ tiêu đề
            $validated['slug'] = Str::slug($validated['title']);

            // Xử lý file upload ảnh đại diện nếu có
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/' . self::PATH_UPLOAD), $filename);
                $validated['thumbnail'] = $filename;
            }

            // Gán user_id (nếu chưa đăng nhập, bạn có thể thiết lập mặc định)
            $validated['user_id'] = auth()->id() ?? 1;
            // Xác định trạng thái dựa trên is_active: nếu is_active == 1 thì published, ngược lại là draft
            $validated['status'] = $validated['is_active'] ? 'published' : 'draft';

            // Tạo bài viết
            $post = Post::create($validated);

            // Xử lý upload nhiều ảnh cho post nếu có (input name: images_post[])
            if ($request->hasFile('images_post')) {
                $images = $request->file('images_post');
                $captions = $request->input('captions', []);
                $displayOrders = $request->input('display_orders', []);

                foreach ($images as $index => $image) {
                    $imgFilename = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('uploads/' . self::PATH_UPLOAD), $imgFilename);

                    // Lưu ảnh vào bảng post_images thông qua quan hệ
                    $post->images()->create([
                        'image_path'    => $imgFilename,
                        'caption'       => $captions[$index] ?? null,
                        'display_order' => $displayOrders[$index] ?? 0,
                    ]);
                }
            }

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
        $post->load('images', 'category', 'user');
        return view(self::PATH_VIEW . 'show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $post->load('images');
        return view(self::PATH_VIEW . 'edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'content' => 'required',
            'category_id' => 'required|exists:post_categories,id',
            'thumbnail' => 'nullable|image|max:2048',
            'status' => 'required|in:published,draft,pending',
            'images_post' => 'nullable|array',
            'images_post.*' => 'image|max:2048',
            'captions' => 'nullable|array',
            'captions.*' => 'nullable|string',
            'display_orders' => 'nullable|array',
            'display_orders.*' => 'nullable|integer',
            'existing_images' => 'nullable|array',
            'delete_images' => 'nullable|array', // Thay đổi tên trường để dễ xử lý
        ]);

        // Xử lý slug
        $validatedData['slug'] = Str::slug($validatedData['title']);
        if (Post::where('slug', $validatedData['slug'])->where('id', '!=', $post->id)->exists()) {
            return back()->withErrors(['title' => 'Tiêu đề đã tồn tại.']);
        }

        // Xử lý ảnh đại diện
        if ($request->hasFile('thumbnail')) {
            // Xóa ảnh cũ nếu tồn tại
            if ($post->thumbnail) {
                $oldThumbnail = public_path('uploads/posts/' . $post->thumbnail);
                if (file_exists($oldThumbnail)) {
                    unlink($oldThumbnail);
                }
            }
            // Lưu ảnh mới
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName();
            $thumbnail->move(public_path('uploads/posts'), $thumbnailName);
            $validatedData['thumbnail'] = $thumbnailName;
        }

        // Cập nhật bài viết
        $post->update($validatedData);

        // Xử lý xóa ảnh được đánh dấu
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = $post->images()->find($imageId);
                if ($image) {
                    // Xóa file ảnh
                    $imagePath = public_path('uploads/posts/' . $image->image_path);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                    // Xóa record
                    $image->delete();
                }
            }
        }

        // Xử lý cập nhật ảnh hiện có
        if ($request->has('existing_images')) {
            foreach ($request->existing_images as $imageId => $data) {
                $image = $post->images()->find($imageId);
                if ($image) {
                    // Cập nhật caption và display_order
                    $image->update([
                        'caption' => $data['caption'] ?? $image->caption,
                        'display_order' => $data['display_order'] ?? $image->display_order,
                    ]);

                    // Xử lý upload ảnh mới thay thế
                    if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
                        // Xóa ảnh cũ
                        $oldImagePath = public_path('uploads/posts/' . $image->image_path);
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                        // Lưu ảnh mới
                        $newImage = $data['image'];
                        $newImageName = time() . '_' . $newImage->getClientOriginalName();
                        $newImage->move(public_path('uploads/posts'), $newImageName);
                        $image->update(['image_path' => $newImageName]);
                    }
                }
            }
        }

        // Xử lý thêm ảnh mới
        if ($request->hasFile('images_post')) {
            foreach ($request->file('images_post') as $index => $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/posts'), $imageName);

                $post->images()->create([
                    'image_path' => $imageName,
                    'caption' => $request->captions[$index] ?? null,
                    'display_order' => $request->display_orders[$index] ?? 0,
                ]);
            }
        }

        return redirect()->route('posts.index')->with('success', 'Cập nhật bài viết thành công.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {

        if ($post->thumbnail && file_exists(public_path('uploads/' . self::PATH_UPLOAD . '/' . $post->thumbnail))) {
            unlink(public_path('uploads/' . self::PATH_UPLOAD . '/' . $post->thumbnail));
        }

        $post->images()->delete();

        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Bài viết đã được xóa thành công.');
    }
}
