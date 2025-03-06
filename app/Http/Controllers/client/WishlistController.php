<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $userId = 1; // ID mặc định để test

        $wishlistItems = \App\Models\Wishlist::where('user_id', $userId)
            ->with('product')
            ->get();
    
        return view('client.pages.wishlist.index', compact('wishlistItems'));
    }
    public function destroy($id)
    {
        
        $wishlistItem = Wishlist::findOrFail($id);

         $wishlistItem->delete();
         return redirect()->route('wishlist.index')->with('success', 'Xóa sản phẩm yêu thích thành công!');

    }
}
