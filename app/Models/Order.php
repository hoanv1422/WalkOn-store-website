<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{
   
    protected $fillable = [
        'user_id',
        'order_code',
        'user_email',
        'user_name',
        'user_address',
        'user_phone',
        'receiver_email',
        'receiver_name',
        'receiver_address',
        'receiver_phone',
        'coupon_id',
        'coupon',
        'total_price',
        'discount_amount',
        'shipping_fee',
        'final_price',
        'order_status',
        'payment_status',
        'payment_method',
        'cart_item_ids',
        'courier_id',
        'payment_date',
        'delivered_at',
        'tracking_code',
    ];
    const ORDER_STATUS_MAPPING = [
        'pending'    => 'Chờ xử lý',
        'confirmed'  => 'Đã xác nhận',
        'processing' => 'Đang xử lý',
        'ready'      => 'Đã chuẩn bị xong',
        'shipped'    => 'Đang giao',
        'delivered'  => 'Đã giao',
        'cancelled'  => 'Đã hủy',
        'returned'   => 'Hoàn hàng',
        'completed'  => 'Hoàn tất trả hàng',
    ];
    /**
     * Get the user that owns the order.
     */
    public function getRouteKeyName()
    {
        return 'order_code';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the items in the order.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the cancellation record associated with the order.
     */
    public function cancellation()
    {
        return $this->hasOne(OrderCancellation::class, 'order_id');
    }

    public function courier()
    {
        return $this->hasOne(Courier::class, 'courier_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    protected $dispatchesEvents = [
        'updated' => \App\Events\OrderStatusChanged::class,
    ];
}
