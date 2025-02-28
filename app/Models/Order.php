<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'user_email',
        'user_name',
        'user_address',
        'user_phone',
        'same_as_buyer',
        'receiver_email',
        'receiver_name',
        'receiver_address',
        'receiver_phone',
        'coupon',
        'order_status',
        'payment_status',
        'payment_method',
        'total_price',
    ];

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
