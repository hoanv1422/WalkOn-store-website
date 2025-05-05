<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Mail\OrderMail;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class CheckoutController extends Controller
{

    public function store(CheckoutRequest $request)
    {


        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn cần đăng nhập để thanh toán.'
                ], 401);
            }

            $cart = Cart::where('user_id', $user->id)->first();
            if (!$cart) {
                return response()->json([
                    'success' => false,
                    'message' => 'Giỏ hàng của bạn trống.'
                ], 404);
            }

            if (empty($request->cartItemIds)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Giỏ hàng trống.'
                ], 400);
            }

            
            $cartItems = CartItem::where('cart_id', $cart->id)->whereIn('id', $request->cartItemIds)
            ->with(['productVariant.product', 'productVariant.size', 'productVariant.color'])
            ->get();

            if ($cartItems->count() !== count($request->cartItemIds)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Một hoặc nhiều sản phẩm trong giỏ hàng không tồn tại'
                ],404);
            }



            $this->validateStock($cartItems);

            $coupon_id = null;
            if ($request->couponCodeForOrder) {
                $coupon_id = Coupon::query()->where("code", $request->couponCodeForOrder)->pluck("id")->first();
            }

            if ($request->payment_method === 'COD') {
                return $this->processCodOrder($user, $cart, $cartItems, $request, $coupon_id);
            } else if ($request->payment_method === 'VNPAY') {
                return $this->processVnpayOrder($user, $cart, $cartItems, $request, $coupon_id);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi đặt đơn hàng: ' . $e->getMessage()
            ], 500);
        }
    }

    private function vnpay_payment($amount, $orderCode)
    {

        $vnp_TmnCode = "81Z6YOTT";
        $vnp_HashSecret = "TK1GHLC8DFV7LPY26X7GID11XJWWLH4Z";
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.return');
        $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
        $apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
        $startTime = date("YmdHis");
        // $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));


        $vnp_TxnRef = $orderCode;
        $vnp_Amount = $amount;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB'; //Mã phương thức thanh toán
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //IP Khách hàng thanh toán

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_TxnRef,
            "vnp_OrderType" => "billpayment",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        // Thay vì header() và die(), trả về URL
        return $vnp_Url;
    }

    // Return VNPay
    public function vnpay_return(Request $request)
    {
        $vnp_HashSecret = env('VNPAY_HASH_SECRET', 'TK1GHLC8DFV7LPY26X7GID11XJWWLH4Z');

        $vnp_TxnRef = $request->input('vnp_TxnRef');
        $vnp_Amount = $request->input('vnp_Amount') / 100;
        $vnp_ResponseCode = $request->input('vnp_ResponseCode');
        $vnp_TransactionNo = $request->input('vnp_TransactionNo');
        $vnp_BankCode = $request->input('vnp_BankCode');
        $vnp_PayDate = $request->input('vnp_PayDate');
        $vnp_SecureHash = $request->input('vnp_SecureHash');

        $inputData = $request->except(['vnp_SecureHash']);
        ksort($inputData);
        $hashData = urldecode(http_build_query($inputData));
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash !== $vnp_SecureHash) {
            // return 1;
            return back()->with('error', 'Dữ liệu không hợp lệ! Chữ ký không khớp.');
        }

        if ($vnp_ResponseCode != '00') {
            return $this->handleVnpayFailure($vnp_TxnRef, $vnp_ResponseCode);
        }

        return $this->handleVnpaySuccess($vnp_TxnRef, $vnp_Amount, $vnp_TransactionNo, $vnp_BankCode, $vnp_PayDate);
    }


    private function handleVnpaySuccess($orderCode, $amount, $transactionNo, $bankCode, $payDate)
    {
        try {
            DB::beginTransaction();

            $order = Order::where('order_code', $orderCode)->first();
            if (!$order) {
                throw new \Exception('Đơn hàng không tồn tại.');
            }

            // Kiểm tra số tiền
            if ($order->final_price != $amount) {
                throw new \Exception('Số tiền thanh toán không khớp với đơn hàng.');
            }

            // Ngăn xử lý trùng lặp
            if ($order->payment_status === 'paid') {
                DB::commit();
                return redirect('/checkout')->with('success', 'Đơn hàng đã được thanh toán trước đó.');
            }

            // Cập nhật trạng thái đơn hàng
            $order->update([
                'payment_status' => 'paid',
                'order_status' => 'confirmed',
            ]);

            // Tạo giao dịch
            $transaction = $this->createVnpayTransaction($order->id, $amount, $transactionNo, $bankCode, $payDate);


            $cartItemIds = json_decode($order->cart_item_ids, true);
            if (!empty($cartItemIds)) {
                CartItem::whereIn('id', $cartItemIds)->delete();
            }
            
            // Cập nhật tồn kho cho đơn hàng VNPAY sau khi thanh toán thành công
            $orderItems = OrderItem::where('order_id', $order->id)
                ->with('productVariant.product')
                ->get();

            // Cập nhật tồn kho
            $this->updateInventoryForVnpay($orderItems);

            // Gửi email xác nhận
            $this->sendVnpayConfirmationEmail($order, $orderItems->toArray());

            DB::commit();
            return redirect('/order-list')->with('success', 'Thanh toán thành công! Đơn hàng của bạn đã được xác nhận.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/order-list')->with('error', 'Có lỗi xảy ra khi xử lý đơn hàng: ' . $e->getMessage());
        }
    }

    private function handleVnpayFailure($orderCode, $responseCode)
    {
        try {
            DB::beginTransaction();

            $order = Order::where('order_code', $orderCode)->first();

            if ($order) {
                // Cập nhật trạng thái đơn hàng thành thất bại
                $order->update([
                    'payment_status' => 'unpaid',
                    'order_status' => 'pending',
                ]);
            }

            $cartItemIds = json_decode($order->cart_item_ids, true);
            if (!empty($cartItemIds)) {
                CartItem::whereIn('id', $cartItemIds)->delete();
            }

            DB::commit();
            return redirect('/order-list')->with('error', 'Thanh toán thất bại, mã lỗi: ' . $responseCode);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/order-list')->with('error', 'Có lỗi xảy ra khi xử lý đơn hàng: ' . $e->getMessage());
        }
    }

    private function createVnpayTransaction($orderId, $amount, $transactionNo, $bankCode, $payDate)
    {
        return Transaction::create([
            'transactions_code' => 'VNP' . date('YmdHis') . strtoupper(Str::random(4)),
            'order_id' => $orderId,
            'amount' => $amount,
            'payment_method' => 'VNPAY',
            'bank_code' => $bankCode,
            'transaction_no' => $transactionNo,
            'payment_date' => $payDate,
            'status' => 'completed',
        ]);
    }

    private function updateInventoryForVnpay($orderItems)
    {
        foreach ($orderItems as $item) {
            $item->productVariant->decrement('quantity', $item->quantity);
            $item->productVariant->product->increment('sold_quantity', $item->quantity);
            $this->updateQuantityProduct($item->productVariant->product_id);
        }
    }

    private function sendVnpayConfirmationEmail($order, $orderItems)
    {
        $token = route('order.list');
        Mail::to($order->user_email)->send(new OrderMail($order, $orderItems, $order->user_name, $token));
    }

    private function processCodOrder($user, $cart, $cartItems, $request, $coupon_id = null)
    {
        try {
            DB::beginTransaction();
            $cartItemIds = $cartItems->pluck('id')->toArray();

            $order = $this->createCodOrder($user, $request, $coupon_id, $cartItemIds);

            $orderItems = $this->createOrderItems($order, $cartItems);

            $this->updateInventoryForCod($cartItems);

            CartItem::where('cart_id', $cart->id)->whereIn('id', $request->cartItemIds)->delete();

            $this->sendCodOrderConfirmationEmail($user, $order, $orderItems);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Đơn hàng COD của bạn đã được đặt thành công.',
                'order' => $order,
                'order_items' => $orderItems
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    // Create Orders
    private function createCodOrder($user, $request, $coupon_id = null, $cartItemIds)
    {
        return Order::create([
            'order_code' => 'COD' . date('Ymd') . strtoupper(Str::random(4)),
            'user_id' => $user->id,
            'user_email' => $user->email,
            'username' => $user->username,
            'user_address' => $user->address,
            'user_phone' => $user->phone,
            'receiver_name' => $request->receiver_name,
            'receiver_email' => $request->receiver_email,
            'receiver_phone' => $request->receiver_phone,
            'receiver_address' => $request->receiver_address,
            'note' => $request->note,
            'coupon_id' => $coupon_id,
            'coupon' => $request->couponCodeForOrder,
            'total_price' => $request->totalPrice,
            'discount_amount' => $request->discountAmount,
            'shipping_fee' => $request->shippingFee,
            'final_price' => $request->finalPrice,
            'order_status' => 'pending', // Đơn hàng COD được xác nhận ngay
            'payment_status' => 'unpaid',   // COD chưa thanh toán
            'payment_method' => 'COD',
            'cart_item_ids' => json_encode($cartItemIds),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function createVnpayOrder($user, $request, $coupon_id = null, $cartItemIds)
    {

        return Order::create([
            'order_code' => 'VNP' . date('Ymd') . strtoupper(Str::random(4)),
            'user_id' => $user->id,
            'user_email' => $user->email,
            'username' => $user->username,
            'user_address' => $user->address,
            'user_phone' => $user->phone,
            'receiver_name' => $request->receiver_name,
            'receiver_email' => $request->receiver_email,
            'receiver_phone' => $request->receiver_phone,
            'receiver_address' => $request->receiver_address,
            'note' => $request->note,
            'coupon_id' => $coupon_id,
            'coupon' => $request->couponCodeForOrder,
            'total_price' => $request->totalPrice,
            'discount_amount' => $request->discountAmount,
            'shipping_fee' => $request->shippingFee,
            'final_price' => $request->finalPrice,
            'order_status' => 'pending',
            'payment_status' => 'unpaid',   
            'payment_method' => 'VNPAY',
            'cart_item_ids' => json_encode($cartItemIds),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }



    private function createOrderItems($order, $cartItems)
    {
        $orderItems = [];
        foreach ($cartItems as $item) {
            $orderItems[] = [
                'order_id' => $order->id,
                'product_variant_id' => $item->product_variant_id,
                'product_name' => $item->productVariant->product->name,
                'product_sku' => $item->productVariant->product->sku,
                'product_image' => $item->productVariant->image,
                'product_price' => $item->productVariant->price,
                'product_price_sale' => $item->productVariant->price_sale,
                'variant_size_name' => $item->productVariant->size->size,
                'variant_color_name' => $item->productVariant->color->color,
                'quantity' => $item->quantity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        OrderItem::insert($orderItems);
        return $orderItems;
    }


    private function processVnpayOrder($user, $cart, $cartItems, $request, $coupon_id = null)
    {
        try {
            DB::beginTransaction();

            $cartItemIds = $cartItems->pluck('id')->toArray();

            // Tạo đơn hàng VNPAY với trạng thái thanh toán là "pending"
            $order = $this->createVnpayOrder($user, $request, $coupon_id, $cartItemIds);

            // Tạo chi tiết đơn hàng
            $orderItems = $this->createOrderItems($order, $cartItems);

            // Xóa các sản phẩm đã đặt khỏi giỏ hàng
            CartItem::where('cart_id', $cart->id)->whereIn('id', $request->cartItemIds)->delete();

            DB::commit();

            // Tạo URL thanh toán VNPAY và chuyển hướng
            $vnpayUrl = $this->vnpay_payment($order->final_price, $order->order_code);

            return response()->json([
                'success' => true,
                'message' => 'Đơn hàng đã được tạo, chuyển hướng đến thanh toán VNPAY',
                'redirect_url' => $vnpayUrl,
                'order' => $order
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateQuantityProduct($productId)
    {
        $totalQuantity = ProductVariant::where('product_id', $productId)->sum('quantity');
        $product = Product::find($productId);
        $product->quantity = $totalQuantity;
        $product->save();
    }

    private function validateStock($cartItems)
    {
        foreach ($cartItems as $item) {
            if ($item->quantity > $item->productVariant->quantity) {
                throw new \Exception('Sản phẩm ' . $item->productVariant->product->name . ' không đủ số lượng.');
            }
        }
    }

    private function updateInventoryForCod($cartItems)
    {
        foreach ($cartItems as $item) {
            $item->productVariant->decrement('quantity', $item->quantity);
            $item->productVariant->product->increment('sold_quantity', $item->quantity);
            $this->updateQuantityProduct($item->productVariant->product_id);
        }
    }

    private function sendCodOrderConfirmationEmail($user, $order, $orderItems)
    {
        $token = route('order.list');
        Mail::to($user->email)->send(new OrderMail($order, $orderItems, $user->name, $token));
    }
}
