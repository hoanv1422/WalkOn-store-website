<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use App\Models\CommentHidden;
use Illuminate\Http\Request;

class AdminCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Lấy các tham số từ bộ lọc 
        $query = Comment::with('user', 'product')->orderBy('created_at', 'desc');
    
        // Lọc theo sản phẩm 
        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }
    
        // Lọc theo người dùng 
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
    
        // Lọc theo trạng thái (hiển thị hoặc ẩn)
        if ($request->filled('hidden_comment')) {
            $query->where('hidden_comment', $request->hidden_comment);
        }
    
        // Lọc theo đánh giá
        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }
    
        // Lấy các bình luận đã lọc
        $comments = $query->paginate(10);
    
        // Truyền dữ liệu sản phẩm và người dùng để hiển thị trong bộ lọc
        $products = Product::all();
        $users = User::all();
    
        return view('admin.comments.index', compact('comments', 'products', 'users'));
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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
    public function hide($id)
    {
        $comment = Comment::findOrFail($id);
    
        // Kiểm tra xem bình luận đã bị ẩn chưa
        if ($comment->hidden_comment != 1) {
            // Đánh dấu bình luận là đã ẩn (cập nhật cột hidden_comment)
            $comment->hidden_comment = 1; // 1 = bị ẩn
            
            $comment->save();
        }
    
        return redirect()->back()->with('success', 'Bình luận đã được ẩn.');
    }
    

    // Xem các bình luận đã ẩn
    // public function hiddenComments()
    // {
    //     $hiddenCommentIds = CommentHidden::pluck('comment_id')->toArray();
    //     $comments = Comment::whereIn('id', $hiddenCommentIds)->get();

    //     return view('admin.comments.hidden', compact('comments'));
    // }
    
    // Hiện lại bình luận đã ẩn
    public function unhide($id)
{
    $comment = Comment::findOrFail($id);

    // Lấy tên tài khoản admin từ thông tin đăng nhập
    $adminUsername = auth()->user()->name;

    // Kiểm tra xem bình luận đã bị ẩn chưa
    if ($comment->hidden_comment != 0) {
        // Đánh dấu bình luận là đã hiển thị lại (cập nhật cột hidden_comment)
        $comment->hidden_comment = 0; // 0 = hiển thị lại
        $comment->last_admin_username = $adminUsername; // Lưu tên tài khoản admin cuối cùng thay đổi
        $comment->save();
    }

    return redirect()->back()->with('success', 'Bình luận đã được hiển thị lại.');
}

}
