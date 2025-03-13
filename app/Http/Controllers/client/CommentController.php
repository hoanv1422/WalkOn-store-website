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


        return view('client.pages.detail.comments', compact('comments', 'productId', 'hasPurchased', 'user'));
    }

    // Xử lý thêm bình luận
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);
 
        $user = Auth::user();
        if (!$user) {
            return redirect()->back()->with('error', 'Bạn cần đăng nhập để bình luận.');
        }

        // Kiểm tra xem người dùng đã mua hàng chưa
        // $hasPurchased = Order::where('user_id', $user->id)
        //     ->whereHas('orders', function ($query) use ($request) {
        //         $query->where('product_variant_id', $request->product_variant_id);
        //     })
        //     ->exists();



        // Lưu bình luận vào database
        Comment::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
            'content' => $request->content,
            'parent_id' =>null,
            'rating'=>$request->rating,
        ]);

        return redirect()->back()->with('success', 'Bình luận của bạn đã được gửi.');
    }
}
