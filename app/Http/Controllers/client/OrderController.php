<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Color;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderCancellation;
use App\Models\OrderCancellationReason;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    
    public function index(Request $request)
    {
        $cartItems = $request->input('cartItems');

        if (empty($cartItems)) {
            return redirect()->route('cart.index')->withErrors(['cart' => 'Không có sản phẩm trong giỏ hàng.']);
        }

        $cartItemIds = explode(',', $cartItems);

        // foreach ($cartItemIds as $cartItemId) {
        //     if (!is_numeric($cartItemId) || (int)$cartItemId <= 0) {
        //         return redirect()->route('cart.index')->withErrors(['cart' => 'Một hoặc nhiều ID sản phẩm không hợp lệ.']);
        //     }
        // }

        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)->first();

        if (!$cart) {
            return redirect()->route('cart.index')->withErrors(['cart' => 'Giỏ hàng không tìm thấy.']);
        }

        $validCartItems = CartItem::where('cart_id', $cart->id)
            ->whereIn('id', $cartItemIds)
            ->get();

        if ($validCartItems->count() !== count($cartItemIds)) {
            return redirect()->route('cart.index')->withErrors(['cart' => 'Một hoặc nhiều sản phẩm không hợp lệ hoặc không thuộc giỏ hàng của bạn.']);
        }

        return view('client.pages.checkout.index');
    }



    public function indexAPI(Request $request)
    {
        try {
            $userId = Auth::id();
            // Fetch addresses
            $addresses = Address::where('user_id', $userId)->get();
            $addressDefault = Address::where('user_id', $userId)
                ->where('is_default', 1)
                ->first();

            if ($addressDefault) {
                $addressDefault->append(['full_address', 'type_label']);
            }
            
            foreach($addresses as $address) {
                $address->append(['full_address', 'type_label']);
            }


            // Fetch cart and items
            $cart = Cart::where('user_id', $userId)->first();

            if (!$cart) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cart not found'
                ], 404);
            }

            $cartItemIds = explode(',', $request->input('cartItems'));
            $cartItems = CartItem::with('productVariant.product', 'productVariant.color', 'productVariant.size')
                ->where('cart_id', $cart->id)
                ->whereIn('id', $cartItemIds)
                ->get();

            if ($cartItems) {
                $cartItems->append(['formatted_price']);
            }

            // Calculate total price
            $totalPrice = 0;
            foreach ($cartItems as $item) {
                if (
                    $item->productVariant->price_sale &&
                    $item->productVariant->price_sale < $item->productVariant->price
                ) {
                    $totalPrice += $item->productVariant->price_sale * $item->quantity;
                } else {
                    $totalPrice += $item->productVariant->price * $item->quantity;
                }
            }

            return response()->json([
                'status' => 'success',
                'data' => [
                    'cartItems' => $cartItems,
                    'cartItemIds' => $cartItemIds,
                    'totalPrice' => $totalPrice,
                    'addresses' => $addresses,
                    'addressDefault' => $addressDefault
                ]
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }




    public function applyCoupon(Request $request)
    {
        // dd($request->all());

        $user = auth()->user();
        $code = $request->couponCode;
        $totalPrice = $request->totalPrice;
        $cartItemIds = $request->cartItemsForCoupon;
        $shippingFee = $request->shippingFeeForCoupon;

        $discount = 0;
        $shippingDiscount = 0;

        $coupon = Coupon::where('code', $code)->where('is_active', 1)->first();
        if (!$coupon) {
            return response()->json(['message' => 'Mã không hợp lệ'], 400);
        }

        $now = now();
        if ($coupon->start_time > $now || $coupon->end_time < $now) {
            return response()->json(['message' => 'Mã đã hết hạn'], 400);
        }

        if ($coupon->max_uses && Order::where('coupon_id', $coupon->id)->count() >= $coupon->max_uses) {
            return response()->json(['message' => 'Mã đã đạt giới hạn sử dụng'], 400);
        }

        if ($coupon->max_uses_per_user && Order::where('coupon_id', $coupon->id)->where('user_id', $user->id)->count() >= $coupon->max_uses_per_user) {
            return response()->json(['message' => 'Bạn đã sử dụng mã này quá số lần'], 400);
        }

        if ($totalPrice < $coupon->minimum_order_value) {
            return response()->json(['message' => 'Đơn hàng không đủ điều kiện để áp dụng mã'], 400);
        }
        $cartItems = CartItem::query()->whereIn('id', $cartItemIds)->get();
        $applicableCategories = $coupon->categories->pluck('id')->toArray();
        $applicableBrands = $coupon->brands->pluck('id')->toArray();

        $valid = false;
        foreach ($cartItems as $item) {
            if (
                in_array($item->productVariant->product->category_id, $applicableCategories) ||
                in_array($item->productVariant->product->brand_id, $applicableBrands)
            ) {
                $valid = true;
                break;
            }
        }

        if (!$valid) {
            return response()->json(['message' => 'Mã không áp dụng cho sản phẩm trong giỏ hàng'], 400);
        }

        if ($coupon->discount_type === 'percentage') {
            $discount = min(($totalPrice * $coupon->discount_value) / 100, $coupon->maximum_discount_amount);
        } elseif ($coupon->discount_type === 'fixed') {
            $discount = min($coupon->discount_value, $totalPrice);
        } elseif ($coupon->discount_type === 'freeship') {
            $shippingDiscount = min($shippingFee, $coupon->max_shipping_discount ?? $shippingFee);
        }

        $finalPrice = $totalPrice - $discount + $shippingFee - $shippingDiscount;

        return response()->json([
            'message' => 'Áp dụng mã thành công',
            'discount' => $discount,
            'shipping_discount' => $shippingDiscount,
            'finalPrice' => $finalPrice
        ]);
    }


    public function ordersList(Request $request)
    {
        $user = Auth::user();
        $query = Order::where('user_id', $user->id)
            ->with(['orderItems' => fn($q) => $q->select('id', 'order_id', 'product_name', 'product_sku', 'product_image', 'product_price', 'product_price_sale', 'variant_size_name', 'variant_color_name', 'quantity')])
            ->with('cancellation') // Load thông tin hủy đơn
            ->select('id', 'order_code', 'user_id', 'user_name', 'user_address', 'user_phone', 'receiver_name', 'receiver_address', 'receiver_phone', 'note', 'coupon', 'order_status', 'payment_status', 'payment_method', 'total_price', 'created_at')
            ->orderBy('created_at', 'desc');

        if ($status = $request->query('status')) {
            $query->where('order_status', $status);
        }

        $orders = $query->paginate(15)->appends(['status' => $status]);
        $categories = Category::all();
        $colors = Color::all();
        $cancellationReasons = OrderCancellationReason::all();

        return view('client.pages.profile.orders', compact('user', 'orders', 'categories', 'colors', 'cancellationReasons'));
    }


    // Hủy đơn hàng
    public function cancelOrder(Request $request, $orderId)
    {
        $order = Order::where('id', $orderId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$order) {
            return response()->json(['error' => 'Đơn hàng không tồn tại hoặc không thuộc về bạn.'], 404);
        }

        if ($order->order_status !== 'pending') {
            return response()->json(['error' => 'Chỉ có thể hủy đơn hàng khi đang ở trạng thái chờ xử lý.'], 403);
        }

        $request->validate([
            'reason' => 'required|string|max:255',
            'custom_reason' => 'nullable|string|max:255|required_if:reason,other',
        ]);

        try {
            DB::beginTransaction();

            $order->order_status = 'cancelled';
            $order->save();

            // Kiểm tra lý do hủy và lưu vào bảng order_cancellations
            $reason = $request->input('reason');
            $reasonId = null;
            $customReason = null;

            if ($reason === 'other') {
                $customReason = $request->input('custom_reason');
            } else {
                $reasonRecord = OrderCancellationReason::where('reason', $reason)->first();
                if ($reasonRecord) {
                    $reasonId = $reasonRecord->id;
                }
            }

            OrderCancellation::create([
                'order_id' => $order->id,
                'reason_id' => $reasonId,
                'custom_reason' => $customReason,
                'cancelled_by_id' => Auth::id(),
                'cancelled_at' => now(),
            ]);

            // Hoàn lại số lượng sản phẩm trong kho
            foreach ($order->orderItems as $item) {
                if ($item->product_variant_id) {
                    $variant = \App\Models\ProductVariant::find($item->product_variant_id);
                    if ($variant) {
                        $variant->increment('quantity', $item->quantity);
                        $variant->product->increment('quantity', $item->quantity);
                    }
                }
            }

            DB::commit();
            return response()->json(['success' => "Đơn hàng #{$order->order_code} đã được hủy."]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()], 500);
        }
    }

    public function createAddress(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();

        $data['user_id'] = $user->id;
        $data['city'] = $request->province_name;
        $data['district'] = $request->district_name;
        $data['ward'] = $request->ward_name;
        $data['address_line'] = $request->address_line;
        $data['type'] = $request->addressType;
        $data['latitude'] = $request->latitude;
        $data['longitude'] = $request->longitude;
        $data['is_default'] = $request->has('default_address') ? 1 : 0;

        try {
            DB::beginTransaction();

            if ($data['is_default'] == 1) {
                Address::where('user_id', $user->id)->update(['is_default' => 0]);
            }

            Address::create($data);

            DB::commit();
            return back()->with('success', 'Thêm địa chỉ thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi khi thêm');
        }
    }
    public function update(Request $request, Order $order)
    {
        // Validate dữ liệu từ form
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'order_date' => 'required|date',
            'total_price' => 'required|numeric',
            'payment_method' => 'required|string',
            'order_status' => 'required|string',
        ]);

        // Cập nhật thông tin đơn hàng
        $order->update([
            'user_name' => $validated['customer_name'], // Map form field 'customer_name' vào cột 'user_name'
            'created_at' => $validated['order_date'],
            'total_price' => $validated['total_price'],
            'payment_method' => $validated['payment_method'],
            'order_status' => $validated['order_status'],
        ]);

        return redirect()->back()->with('success', 'Cập nhật đơn hàng thành công!');
    }
}
