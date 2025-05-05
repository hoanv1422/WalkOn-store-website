<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderReview extends Model
{
    use HasFactory;

    // Các trường được phép gán (mass assignable)
    protected $fillable = [
        'order_id',
        'user_id',
        'courier_id',
        'rating',
        'comment',
        'product_quality',
        'delivery_service',
    ];

    // Quan hệ với bảng `orders`
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Quan hệ với bảng `users`
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
