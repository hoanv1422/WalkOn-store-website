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
use Illuminate\Support\Facades\Validator;

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
    public function storeComment(Request $request, $slug)
    {

        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|max:1000',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
        ], [
            'rating.required' => 'Vui lòng chọn số sao đánh giá.',
            'rating.integer' => 'Số sao đánh giá không hợp lệ.',
            'rating.min' => 'Số sao thấp nhất là 1.',
            'rating.max' => 'Số sao cao nhất là 5.',

            'content.required' => 'Vui lòng nhập nội dung bình luận.',
            'content.string' => 'Nội dung bình luận không hợp lệ.',
            'content.max' => 'Nội dung bình luận không được vượt quá 1000 ký tự.',

            'image.*.image' => 'Tệp tải lên phải là hình ảnh.',
            'image.*.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif hoặc webp.',
        ]);


        // Trả về lỗi nếu validate thất bại
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $validator->errors()
            ], 422);
        }
        // Bước 2: Tìm sản phẩm theo slug
        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Sản phẩm không tồn tại.',
            ], 404);
        }

        // Bước 3: Kiểm tra người dùng đã đăng nhập chưa
        $user = auth()->user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn cần đăng nhập để bình luận.',
            ], 401);
        }

        // Bước 4: Lấy danh sách các biến thể của sản phẩm
        $productVariantIds = ProductVariant::where('product_id', $product->id)->pluck('id');

        // Bước 5: Kiểm tra user đã mua sản phẩm và đơn hàng đã hoàn thành
        $completedOrder = Order::where('user_id', $user->id)
            ->where('order_status', 'completed')
            ->whereHas('orderItems', function ($query) use ($productVariantIds) {
                $query->whereIn('product_variant_id', $productVariantIds);
            })
            ->first();

        if (!$completedOrder) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn cần hoàn tất đơn hàng chứa sản phẩm này trước khi bình luận.',
            ], 403);
        }

        // Bước 6: Kiểm tra đã bình luận cho sản phẩm trong đơn hàng này chưa
        $existingComment = Comment::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->where('order_id', $completedOrder->id)
            ->first();

        if ($existingComment) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn đã bình luận cho sản phẩm này trong đơn hàng này.',
            ], 403);
        }

        // Bước 7: Tạo bình luận
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->product_id = $product->id;
        $comment->order_id = $completedOrder->id;
        $comment->rating = $request->rating;
        $comment->content = $request->content;

        $comment->save();

        // Nếu có hình ảnh, lưu vào bảng comment_galleries
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $path = $file->store('comments', 'public');

                $comment->galleries()->create([
                    'image' => $path,
                ]);
            }
        }

        $this->updateProductAverageRating($product->id);

        return response()->json([
            'success' => true,
            'message' => 'Bình luận của bạn đã được ghi nhận.',
            'data' => $comment,
        ], 201);
    }

    private function updateProductAverageRating($productId)
    {
        // Lấy tất cả các đánh giá của sản phẩm
        $ratings = Comment::where('product_id', $productId)->pluck('rating');

        // Tính trung bình đánh giá nếu có bình luận
        if ($ratings->count() > 0) {
            $averageRating = $ratings->avg();

            // Làm tròn đến 1 chữ số thập phân
            $averageRating = round($averageRating, 1);

            // Cập nhật giá trị average_rating trong bảng product
            Product::where('id', $productId)->update(['average_rating' => $averageRating]);
        } else {
            // Nếu không có bình luận nào, đặt average_rating = 0
            Product::where('id', $productId)->update(['average_rating' => 0]);
        }
    }
    function deleteComment(Request $request, $id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json([
                'success' => false,
                'message' => 'Bình luận không tồn tại.',
            ], 404);
        }

        // Kiểm tra xem người dùng có quyền xóa bình luận này không
        if ($comment->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn không có quyền xóa bình luận này.',
            ], 403);
        }
        
        // Xóa bình luận
        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Bình luận đã được xóa thành công.',
        ]);


    }
}
