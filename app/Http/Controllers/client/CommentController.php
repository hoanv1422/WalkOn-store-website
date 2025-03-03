<?php

namespace App\Http\Controllers\Client;

use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use App\Http\Controllers\Client\DetailController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // public function index()
    // {
    //     Comment::all();
        
    // }
    public function store(Request $request, $productId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'rating' => 'required|integer|between:1,5',  // Đảm bảo rating từ 1 đến 5
        ]);

        $product = Product::findOrFail($productId);
        $user = User::findOrFail(Auth::id());

        Comment::create([
            'content' => $request->content,
            'user_id' => $user->id,
            'product_id' => $product->id,
            'rating' => $request->rating,
            'parent_id' => null,  // Bình luận gốc không có parent_id
        ]);
        return redirect()->route('detail.index', $product->slug)->with('success', 'bình luận đã được gửi!');
    }

    public function reply(Request $request, $commentId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $parentComment = Comment::findOrFail($commentId);
        $product = $parentComment->product;
        $user = User::findOrFail(Auth::id());

        Comment::create([
            'content' => $request->content,
            'user_id' => $user->id,
            'product_id' => $product->id,
            'parent_id' => $parentComment->id,  // Đây là bình luận trả lời
            'rating' => null,  // Không cần rating cho bình luận trả lời
        ]);

        return redirect()->route('detail.index', $product->slug)->with('success', 'Trả lời đã được gửi!');
    }

    public function destroy($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        // Kiểm tra xem người dùng có quyền xóa bình luận này không
        if ($comment->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Bạn không có quyền xóa bình luận này.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Bình luận đã được xóa.');
    }
}

