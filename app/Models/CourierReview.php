<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourierReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'courier_id',
        'user_id',
        'order_id',
        'rating',
        'comment',
    ];

    /**
     * Get the courier that the review belongs to.
     */
    public function courier()
    {
        return $this->belongsTo(Courier::class);
    }

    /**
     * Get the user who wrote the review.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the order related to the review.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
