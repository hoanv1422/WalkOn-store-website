<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
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
use Illuminate\Support\Str;


class CheckoutController extends Controller
{

    public function store(CheckoutRequest $request)
    {

        // dd($request->all());

        try {
            $user = Auth::user();

            if (!$user) {
                return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thanh toán.');
            }

            $cart = Cart::where('user_id', $user->id)->first();
            if (!$cart) {
                return redirect()->route('cart.list')->with('error', 'Giỏ hàng của bạn trống.');
            }

            if (Empty($request->cartItemIds)) {
                return back()->with('error', 'Giỏ hàng trống.');
            }

            $cartItems = CartItem::where('cart_id', $cart->id)->whereIn('id', $request->cartItemIds)
                ->with(['productVariant.product', 'productVariant.size', 'productVariant.color'])
                ->get();

            $coupon_id = Coupon::query()->where("code", $request->couponCodeForOrder)->pluck("id")->first();

            DB::beginTransaction();

            foreach ($cartItems as $item) {
                if ($item->quantity > $item->productVariant->quantity) {
                    throw new \Exception('Sản phẩm ' . $item->productVariant->product->name . ' không đủ số lượng.');
                }
            }

            $order = Order::create([
                'order_code' => 'ORD' . date('Ymd') . strtoupper(Str::random(4)),
                'user_id' => $user->id,
                'user_email' => $user->mail,
                'user_name' => $user->username,
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
                'payment_status' => $request->payment_method === 'COD' ? 'unpaid' : 'unpaid',
                'payment_method' => $request->payment_method,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

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
                $item->productVariant->decrement('quantity', $item->quantity);
                $this->updateQuantityProduct($item->productVariant->product_id);
                $item->productVariant->product->increment('sold_quantity', $item->quantity);
            }
            OrderItem::insert($orderItems);
            CartItem::where('cart_id', $cart->id)->whereIn('id', $request->cartItemIds)->delete();

            if ($request->payment_method === 'VNPAY') {
                DB::commit();
                $vnpayUrl = $this->vnpay_payment($order->final_price, $order->order_code);
                return redirect()->away($vnpayUrl);
            }

            DB::commit();
            return redirect()->route('cart.index')->with('success', 'Đơn hàng của bạn đã được đặt thành công.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi đặt đơn hàng: ' . $e->getMessage());
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
        header('Location: ' . $vnp_Url);
        die();
    }


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
            return redirect('/order')->with('error', 'Dữ liệu không hợp lệ! Chữ ký không khớp.');
        }

        if ($vnp_ResponseCode != '00') {

            return redirect('/order')->with('error', 'Thanh toán thất bại, mã lỗi: ' . $vnp_ResponseCode);
        }


        try {
            DB::beginTransaction();
            $order = Order::where('order_code', $vnp_TxnRef)->first();
            if (!$order) {
                throw new \Exception('Đơn hàng không tồn tại.');
            }

            // Kiểm tra số tiền
            if ($order->final_price != $vnp_Amount) {
                throw new \Exception('Số tiền thanh toán không khớp với đơn hàng.');
            }

            if ($order->payment_status === 'paid') {
                return;
            }

            $order->update([
                'payment_status' => 'paid',
                'order_status' => 'confirmed',
            ]);


            Transaction::create([
                'transactions_code' => 'TXN' . date('YmdHis') . strtoupper(Str::random(4)),
                'order_id' => $order->id,
                'amount' => $vnp_Amount,
                'payment_method' => 'VNPAY',
                'status' => 'completed',
            ]);
            DB::commit();
            return redirect('/order')->with('success', 'Thanh toán thành công! Đơn hàng của bạn đã được xác nhận.');
        } catch (\Exception $e) {
            dd($e);
            return redirect('/order')->with('error', 'Có lỗi xảy ra khi xử lý đơn hàng: ' . $e->getMessage());
        }
    }

    public function updateQuantityProduct($productId)
    {
        $totalQuantity = ProductVariant::where('product_id', $productId)->sum('quantity');
        $product = Product::find($productId);
        $product->quantity = $totalQuantity;
        $product->save();
    }
}
