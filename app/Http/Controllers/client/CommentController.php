<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
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

        // Kiểm tra xem người dùng đã mua sản phẩm này chưa
        // $hasPurchased = Order::where('user_id', $user->id)
        //     ->whereHas('orderDetails', function ($query) use ($request) {
        //         $query->where('product_id', $request->product_id);
        //     })
        //     ->exists();

        // if (!$hasPurchased) {
        //     return redirect()->back()->with('error', 'Bạn cần mua sản phẩm này trước khi bình luận.');
        // }

        // Kiểm tra xem người dùng đã bình luận sản phẩm này chưa
        // $existingComment = Comment::where('user_id', $user->id)
        //     ->where('product_id', $request->product_id)
        //     ->first();

        // if ($existingComment) {
        //     return redirect()->back()->with('error', 'Bạn chỉ có thể bình luận một lần cho mỗi sản phẩm.');
        // }

        // Lưu bình luận vào database
        Comment::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
            'content' => $request->content,
            'parent_id' => null,
            'rating' => $request->rating,
        ]);

        return redirect()->back()->with('success', 'Bình luận của bạn đã được gửi.');
    }
}
