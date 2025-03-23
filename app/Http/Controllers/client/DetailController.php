<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Comment;
use App\Models\CommentHidden;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class DetailController extends Controller
{
    public function productDetail(string $slug, Request $request)
    {
        $product = Product::with('galleries', 'variants', 'colors', 'sizes', 'comments')->where('slug', $slug)->first();
        $user = Auth::user();
           // Lấy số sao từ request nếu có
        $rating = $request->query('rating'); // Đọc giá trị rating từ query string
        $comments = Comment::where('product_id', $product->id)
        ->with('user')
        ->whereNotIn('id', CommentHidden::pluck('comment_id')->toArray())  // Lọc các bình luận đã bị ẩn
        ->latest()
        ->get();

                // Lấy tất cả bình luận, lọc theo sản phẩm và kiểm tra nếu bình luận không bị ẩn
        $commentsQuery = Comment::where('product_id', $product->id)
                ->with('user')
                ->whereNotIn('id', CommentHidden::pluck('comment_id')->toArray())  // Lọc các bình luận đã bị ẩn
                ->latest();
    
            // Nếu có filter theo rating, áp dụng điều kiện lọc
            if ($rating) {
                $commentsQuery->where('rating', $rating);
            }
    
            // Lấy bình luận đã lọc
            $comments = $commentsQuery->get();

     $averageRating = Comment::where('product_id', $product->id)
        ->whereNotIn('id', function ($query) {
        $query->select('comment_id')
              ->from('comment_hidden');
    })
    ->avg('rating');
   
    if ($rating) {
        $comments->where('rating', $rating);
    }

    // Lấy bình luận đã lọc
    // $comments = $comments->get();

        $relatedProducts = $product->relatedProducts();
        $upSellProducts = $product->upsellProducts();

        // Kiểm tra xem người dùng đã mua sản phẩm hay chưa
        $hasPurchased = false;
        if ($user && $product->variants->isNotEmpty()) {
            $hasPurchased = Order::where('user_id', $user->id)
                ->whereHas('orderItems', function ($query) use ($product) {
                    $query->whereIn('product_variant_id', $product->variants->pluck('id')->toArray());
                })
                ->exists();
        }
        $existingComment = Comment::where('user_id', $user->id)
        ->where('product_id', $product->id)
        ->first();
   


        $productVariants = $product->variants->map(function ($variant) {
            return [
                'id' => $variant->id,
                'color_id' => $variant->color_id,
                'size_id' => $variant->size_id,
                'quantity' => $variant->quantity,
                'image' => Storage::url($variant->image ?? $variant->product->image),
            ];
        });
    
        return view('client.pages.detail.index', compact('product', 'relatedProducts', 'upSellProducts', 'comments', 'productVariants', 'user', 'hasPurchased','averageRating','existingComment'));
    }

    public function index()
    {
        return view('client.pages.detail.index');
    }
}