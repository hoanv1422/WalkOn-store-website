<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommentHidden;
use Illuminate\Http\Request;

class CommentHiddenController extends Controller
{
    // Show all hidden comments
    public function index()
    {
        $hiddenComments = CommentHidden::all(); 
        return view('admin.commentshidden.index', compact('hiddenComments'));
    }

    public function show($id)
    {
        // Find the hidden comment by its ID
        // $hiddenComment = CommentHidden::findOrFail($id);
        
        // Pass the hidden comment to the view
        // return view('admin.commentshidden.index');
    }
    // Store a newly hidden comment
    public function store(Request $request)
    {

    }

    // Remove a comment from the hidden list
    public function destroy($id)
    {

    }

}

