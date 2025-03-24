<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        // Kiểm tra nếu người dùng chưa đăng nhập
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem danh sách yêu thích.');
        }

        // Lấy danh sách wishlist của người dùng hiện tại
        $userId = auth()->id();
        $wishlistItems = Wishlist::where('user_id', $userId)
            ->with('product')
            ->get();

        return view('client.pages.wishlist.index', compact('wishlistItems'));
    }

    public function destroy($id)
    {
        // Kiểm tra nếu người dùng chưa đăng nhập
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xoá sản phẩm yêu thích.');
        }

        // Chỉ cho phép người dùng xoá các mục thuộc về chính họ
        $wishlistItem = Wishlist::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $wishlistItem->delete();

        return redirect()->route('wishlist.index')->with('success', 'Xóa sản phẩm yêu thích thành công!');
    }
    public function store(Request $request)
    {
        $userId = auth()->id();
        if (!$userId) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn cần đăng nhập để thêm sản phẩm vào danh sách yêu thích.'
                ], 401);
            }
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thêm sản phẩm vào danh sách yêu thích.');
        }

        $productId = $request->input('product_id');
        $action = $request->input('action', 'add');

        if ($action == 'remove') {
            // Xoá sản phẩm khỏi wishlist nếu tồn tại
            $wishlistItem = Wishlist::where('user_id', $userId)
                ->where('product_id', $productId)
                ->first();
            if ($wishlistItem) {
                $wishlistItem->delete();
                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Đã xoá sản phẩm khỏi danh sách yêu thích thành công!'
                    ], 200);
                }
                return redirect()->back()->with('success', 'Đã xoá sản phẩm khỏi danh sách yêu thích thành công!');
            } else {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Sản phẩm không tồn tại trong danh sách yêu thích!'
                    ], 200);
                }
                return redirect()->back()->with('error', 'Sản phẩm không tồn tại trong danh sách yêu thích!');
            }
        } else {
            // Thêm sản phẩm vào wishlist
            $existing = Wishlist::where('user_id', $userId)
                ->where('product_id', $productId)
                ->first();
            if ($existing) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Sản phẩm đã có trong danh sách yêu thích.'
                    ], 200);
                }
                return redirect()->back()->with('error', 'Sản phẩm đã có trong danh sách yêu thích.');
            }

            Wishlist::create([
                'user_id'    => $userId,
                'product_id' => $productId,
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Đã thêm sản phẩm vào danh sách yêu thích thành công!'
                ], 200);
            }

            return redirect()->back()->with('success', 'Đã thêm sản phẩm vào danh sách yêu thích thành công!');
        }
    }
}
