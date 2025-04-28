<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCancellation extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'reason_id',
        'custom_reason',
        'cancelled_by_id',
        'cancelled_at'
    ];

    protected $dates = ['cancelled_at'];

    /**
     * Mối quan hệ: Đơn hàng bị hủy thuộc về một đơn hàng.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Mối quan hệ: Đơn hàng bị hủy có một lý do hủy.
     */
    public function reason()
    {
        return $this->belongsTo(OrderCancellationReason::class, 'reason_id');
    }

    /**
     * Mối quan hệ: Người hủy đơn hàng (customer hoặc admin).
     */
    public function cancelledBy()
    {
        return $this->belongsTo(User::class, 'cancelled_by_id');
    }
}
