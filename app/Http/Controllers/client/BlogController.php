<?php

namespace App\Http\Controllers\Client;

use App\Models\Post;
use App\Models\PostComments;
use Illuminate\Http\Request;
use App\Models\PostCategories;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        // Lấy bài viết với quan hệ category và user, chỉ lấy bài viết published
        $query = Post::with(['category', 'user'])
            ->where('status', 'published')
            ->orderBy('created_at', 'desc');

        // Chỉ lấy bài viết mà danh mục của nó cũng active 
        $query->whereHas('category', function ($q) {
            $q->where('is_active', true);
        });

        // Lọc theo từ khóa tìm kiếm (tiêu đề)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'LIKE', "%{$search}%");
        }

        // Lọc theo trạng thái bài viết 
        if ($request->filled('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // Lọc theo ngày (date range)
        if ($request->filled('date')) {
            // date range có định dạng "01 Jan, 2025 - 31 Jan, 2025"
            $dates = explode('-', $request->date);
            if (count($dates) == 2) {
                $start = trim($dates[0]);
                $end   = trim($dates[1]);
                $startDate = date('Y-m-d 00:00:00', strtotime($start));
                $endDate   = date('Y-m-d 23:59:59', strtotime($end));
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }
        }

        // Lọc theo danh mục bài viết 
        if ($request->filled('post_category') && $request->post_category != 'all') {
            $postCategory = $request->post_category;
            $query->whereHas('category', function ($q) use ($postCategory) {
                $q->where('slug', $postCategory)
                    ->where('is_active', true); // Chỉ lấy danh mục active
            });
        }

        // Phân trang, ví dụ 6 bài viết mỗi trang
        $posts = $query->paginate(6);

        // Lấy danh mục chỉ hiển thị các danh mục active,
        // và đếm bài viết chỉ tính những bài viết published
        $categories = PostCategories::where('is_active', true)
            ->withCount(['posts' => function ($q) {
                $q->where('status', 'published');
            }])->get();
        $totalPosts = Post::where('status', 'published')->count();

        return view('client.pages.blog.index', compact('posts', 'categories', 'totalPosts'));
    }

    public function category($slug)
    {
        // Lấy danh mục theo slug và active
        $category = PostCategories::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Lọc bài viết theo danh mục 
        $posts = Post::with(['category', 'user'])
            ->where('category_id', $category->id)
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        $categories = PostCategories::where('is_active', true)
            ->withCount(['posts' => function ($q) {
                $q->where('status', 'published');
            }])->get();
        $totalPosts = Post::where('status', 'published')->count();

        return view('client.pages.blog.index', compact('posts', 'categories', 'totalPosts'));
    }

    public function details(Request $request, $slug)
    {
     
        $post = Post::with([
            'category',
            'user',
            'comments' => function ($query) {
                $query->whereIn('status', ['published'])
                    ->orderBy('created_at', 'desc');
            },
            'comments.user',
            'comments.replies' => function ($query) {
                $query->whereIn('status', ['published'])
                    ->orderBy('created_at', 'desc');
            },
            'comments.replies.user'
        ])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Nếu danh mục của bài viết không active thì không hiển thị (404)
        if (!$post->category->is_active) {
            abort(404);
        }

        $categories = PostCategories::where('is_active', true)
            ->withCount(['posts' => function ($q) {
                $q->where('status', 'published');
            }])->get();

        return view('client.pages.blog-detail.index', compact('post', 'categories'));
    }

    public function storeComment(Request $request, $slug)
    {
        try {
            
            $userId = auth()->id() ;

            $validatedData = $request->validate([
                'content' => 'required|min:3',
                'parent_id' => 'nullable|exists:post_comments,id'
            ]);

            $post = Post::where('slug', $slug)
                ->where('status', 'published')
                ->firstOrFail();

            $comment = PostComments::create([
                'post_id' => $post->id,
                'user_id' => $userId,
                'content' => $validatedData['content'],
                'status' => 'published',
                'parent_id' => $validatedData['parent_id'] ?? null,
            ]);

            $comment->load('user');

            $html = view('client.pages.blog-detail.comment', compact('comment', 'post'))->render();

            return response()->json([
                'success' => true,
                'html' => $html,
                'comment' => [
                    'id' => $comment->id,
                    'parent_id' => $comment->parent_id
                ],
                'message' => 'Bình luận đã được gửi thành công'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroyComment(PostComments $comment)
    {
        try {
            if (!auth()->check()) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            if (Gate::denies('delete-comment', $comment)) {
                return response()->json(['message' => 'Forbidden'], 403);
            }

            $isParent = is_null($comment->parent_id);
            $comment->delete();

            return response()->json([
                'success' => true,
                'is_parent' => $isParent, 
                'message' => 'Xóa bình luận thành công!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi server: ' . $e->getMessage()
            ], 500);
        }
    }
}
