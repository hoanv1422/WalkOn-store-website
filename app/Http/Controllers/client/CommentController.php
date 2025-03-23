<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\CommentGallery;
use App\Models\Comment;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    // Hiển thị trang bình luận của sản phẩm
    public function show($productId)
    {
        $comments = Comment::where('product_id', $productId)->with('user')->latest()->get();
        $user = Auth::user();

        // Tính điểm trung bình của các bình luận
        $averageRating = Comment::where('product_id', $productId)->avg('rating');

        // Kiểm tra xem người dùng đã mua sản phẩm này chưa
        $hasPurchased = Order::where('user_id', $user->id)
            ->whereHas('orderDetails', function ($query) use ($productId) {
                $query->where('product_id', $productId);
            })
            ->exists();

        return view('client.pages.detail.comments', compact('comments', 'productId', 'hasPurchased', 'user', 'averageRating'));
    }

    // Xử lý thêm bình luận
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);
    
        $user = Auth::user();
        if (!$user) {
            return redirect()->back()->with('error', 'Bạn cần đăng nhập để bình luận.');
        }
    
        // Lưu bình luận vào database
        $comment = Comment::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
            'content' => $request->content,
            'parent_id' => null,
            'rating' => $request->rating,
        ]);
    
        // Kiểm tra và lưu ảnh nếu có
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Lưu ảnh vào thư mục 'public/comments'
                $path = $image->store('img/comment', 'public');
    
                // Lưu thông tin ảnh vào bảng comment_galleries
                CommentGallery::create([
                    'comment_id' => $comment->id,  // Dùng ID của bình luận vừa tạo
                    'image' => $path,  // Lưu đường dẫn ảnh vào trường 'image'
                ]);
            }
        }
    
        return redirect()->back()->with('success', 'Bình luận của bạn đã được gửi.');
    }
    
}
