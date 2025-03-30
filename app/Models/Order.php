<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

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
        'payment_date',
        'delivered_at',
        'tracking_code',
    ];

    /**
     * Get the user that owns the order.
     */
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
}
