<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Address;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Color;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderCancellation;
use App\Models\OrderCancellationReason;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

            foreach ($addresses as $address) {
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


    public function ordersListPage()
    {
        return view('client.pages.order.index');
    }


    public function ordersList(Request $request)
    {
        $userId = Auth::id();

        if (!$userId) {
            return redirect()->route('login.form');
        }

        $statuses = $request->query('status', 'all');
        $search = $request->query('search', '');

        $query = Order::with(['orderItems.product', 'orderItems.productVariant', 'cancellation'])
            ->where('user_id', $userId);


        // Filter by status
        if ($statuses !== 'all') {
            $statuses = is_array($statuses) ? $statuses : explode(',', $statuses);
            $query->whereIn('order_status', $statuses);
        }
        // Search functionality
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('order_code', 'like', "%{$search}%")
                    ->orWhereHas('orderItems', function ($subQuery) use ($search) {
                        $subQuery->where('product_name', 'like', "%{$search}%");
                    });
            });
        }

        // Order by latest
        $query->latest();

        $orders = $query->get();

        return new OrderCollection($orders);
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

    public function orderDetailPage()
    {
        return view('client.pages.order.order-detail.index');
    }

    public function orderDetail($orderCode)
    {
        try {
            // Fetch the order with its order items using the orderCode
            $order = Order::with('orderItems')
                ->where('order_code', $orderCode)
                ->first();

            // Check if order exists
            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found',
                ], 404);
            }
            return new OrderResource($order);
        } catch (\Exception $e) {
            // Handle any errors
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching order details',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function CancelReason()
    {
        try {
            // Fetch the order with its order items using the orderCode
            $cancelReason = OrderCancellationReason::all();
            // Check if order exists
            if (!$cancelReason) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Cancel Reason found',
                'data' => $cancelReason
            ], 200);
        } catch (\Exception $e) {
            // Handle any errors
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching order details',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function cancelOrder(Request $request, $orderId)
    {
        // return response()->json([
        //     'message' => 'Order not found or does not belong to you.',
        //     'errors' => ['order_id' => 'The specified order does not exist or is not accessible.'],
        //     'data' => $request->all()
        // ], 404);


        // Find the order that belongs to the authenticated user
        $order = Order::where('id', $orderId)
            ->where('user_id', Auth::id())
            ->first();

        // Check if order exists and belongs to the user
        if (!$order) {
            return response()->json([
                'message' => 'Order not found or does not belong to you.',
                'errors' => ['order_id' => 'The specified order does not exist or is not accessible.']
            ], 404);
        }

        // Check if order is in a cancellable state
        if ($order->order_status !== 'pending') {
            return response()->json([
                'message' => 'Order cannot be cancelled.',
                'errors' => ['order_status' => 'Only orders in pending status can be cancelled.']
            ], 403);
        }

        // Validate the request inputs
        $validated = $request->validate([
            'reason_code' => 'nullable|string|max:255',
            'reason_text' => 'nullable|string|max:255|required_if:reason,other',
        ]);

        try {
            // Begin transaction to ensure data integrity
            DB::beginTransaction();

            // Update order status
            $order->order_status = 'cancelled';
            $order->save();

            // Handle reason for cancellation
            $reason = $validated['reason_code'];
            $customReason = null;

            if ($reason === null) {
                $customReason = $validated['reason_text'];
            } else {
                $reasonRecord = OrderCancellationReason::where('reason', $reason)->first();
                $reasonId = $reasonRecord ? $reasonRecord->id : null;
            }

            // Create cancellation record

            OrderCancellation::create([
                'order_id' => $order->id,
                'reason_id' => $reason,
                'custom_reason' => $customReason,
                'cancelled_by_id' => Auth::id(),
                'cancelled_at' => now(),
            ]);

            // Restore product quantities to inventory
            foreach ($order->orderItems as $item) {
                if ($item->product_variant_id) {
                    $variant = \App\Models\ProductVariant::findOrFail($item->product_variant_id);
                    $variant->increment('quantity', $item->quantity);

                    // Also update the parent product's quantity
                    if ($variant->product) {
                        $variant->product->increment('quantity', $item->quantity);
                    }
                }
            }

            // Commit all database changes
            DB::commit();

            // Return success response
            return response()->json([
                'success' => true,
                'message' => "Order #{$order->order_code} has been cancelled successfully.",
                'data' => [
                    'order_id' => $order->id,
                    'order_code' => $order->order_code,
                    'status' => $order->order_status
                ]
            ], 200);
        } catch (\Exception $e) {
            // Roll back transaction if anything fails
            DB::rollBack();

            // Log the error for debugging
            Log::error('Order cancellation failed: ' . $e->getMessage(), [
                'order_id' => $orderId,
                'user_id' => Auth::id(),
                'exception' => $e
            ]);

            return response()->json([
                'message' => 'An error occurred while cancelling the order.',
                'errors' => ['server' => 'Internal server error.']
            ], 500);
        }
    }
}
