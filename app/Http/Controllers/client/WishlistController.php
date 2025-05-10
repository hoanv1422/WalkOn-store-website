<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = Wishlist::where('user_id', Auth::id())->with('product')->get();
        return view('client.pages.wishlist.index', compact('wishlistItems'));
    }

    public function destroy(Request $request, $id)
    {
        $wishlistItem = Wishlist::where('user_id', Auth::id())
            ->where('id', $id)
            ->first();

        if (!$wishlistItem) {
            // If AJAX request, return JSON
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error'   => 'Sản phẩm không tồn tại hoặc không thuộc về bạn.'
                ], 404);
            }
            return redirect()
                ->route('wishlist.index')
                ->with('error', 'Sản phẩm không tồn tại hoặc không thuộc về bạn.');
        }

        $wishlistItem->delete();

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()
            ->route('wishlist.index')
            ->with('success', 'Xóa sản phẩm khỏi Wishlist thành công!');
    }


    public function toggle(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Bạn cần đăng nhập để sử dụng wishlist'], 401);
        }

        $wishlistItem = Wishlist::where('user_id', Auth::id())->where('product_id', $request->product_id)->first();

        if ($wishlistItem) {
            return response()->json(['redirect' => route('wishlist.index')]);
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id
            ]);
            return response()->json(['message' => 'Đã thêm vào Wishlist']);
        }
    }
}
