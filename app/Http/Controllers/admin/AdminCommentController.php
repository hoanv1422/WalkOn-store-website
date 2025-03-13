<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\CommentHidden;
use Illuminate\Http\Request;

class AdminCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::with('user', 'product','replies')
        ->orderBy('created_at', 'desc')->paginate(10);

    return view('admin.comments.index', compact('comments'));
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
        if (!CommentHidden::where('comment_id', $id)->exists()) {
            // Tạo một bản ghi trong bảng comment_hidden để đánh dấu bình luận bị ẩn
            CommentHidden::create([
                'comment_id' => $id,
                'hidden_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Bình luận đã được ẩn.');
    }

    // Xem các bình luận đã ẩn
    public function hiddenComments()
    {
        $hiddenCommentIds = CommentHidden::pluck('comment_id')->toArray();
        $comments = Comment::whereIn('id', $hiddenCommentIds)->get();

        return view('admin.comments.hidden', compact('comments'));
    }
}
