<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\CommentGallery;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class CommentController extends Controller
{
    public function comments(string $slug, Request $request)
    {
        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return response()->json([
                'message' => 'Product not found.'
            ], 404);
        }
        $query = $product->comments()->latest();

        // Nếu có truyền số sao (rating), lọc theo rating
        if ($request->has('rating')) {
            $rating = (int) $request->input('rating');
            if ($rating >= 1 && $rating <= 5) {
                $query->where('rating', $rating);
            }
        }

        $comments = $query->with('galleries')->get();
        if ($comments->isEmpty()) {
            return response()->json([
                'message' => 'Không có comment nào.'
            ], 200);
        }

        return response()->json([
            'success' => true,
            'message' => "Lấy bình luận thành công",
            'data' => $comments
        ]);
    }
    // Xử lý thêm bình luận
    public function storeComment(Request $request)
    {

        dd($request->all());
        // Validate request
        // $validator = Validator::make($request->all(), [
        //     'rating' => 'required|integer|min:1|max:5',
        //     'content' => 'required|string|max:1000',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Validation error',
        //         'errors' => $validator->errors()
        //     ], 422);
        // }

        // Find the product
        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found.'
            ], 404);
        }

        // Get current authenticated user
        $user = auth()->user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn cần đăng nhập để bình luận.'
            ], 401);
        }

        $productVariantIds = ProductVariant::where('product_id', $product->id)->pluck('id')->toArray();

        // Check if user has any completed order containing any variant of this product
        $completedOrder = Order::where('user_id', $user->id)
            ->where('status', 'completed') // Assuming 'completed' is the status for completed orders
            ->whereHas('orderItems', function ($query) use ($productVariantIds) {
                $query->whereIn('product_variant_id', $productVariantIds);
            })
            ->first();

        if (!$completedOrder) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn cần mua và hoàn thành đơn hàng với sản phẩm này trước khi bình luận.'
            ], 403);
        }

        // Check if user has already commented on this product from this order
        $existingComment = Comment::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->where('order_id', $completedOrder->id)
            ->first();

        if ($existingComment) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn đã bình luận cho sản phẩm này với đơn hàng này rồi.'
            ], 403);
        }

        // Create the comment
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->product_id = $product->id;
        // $comment->order_id = $completedOrder->id;
        $comment->rating = $request->rating;
        $comment->content = $request->content;
        $comment->save();

        return response()->json([
            'success' => true,
            'message' => 'Bình luận của bạn đã được ghi nhận.',
            'data' => $comment
        ], 201);
    }
    
}
