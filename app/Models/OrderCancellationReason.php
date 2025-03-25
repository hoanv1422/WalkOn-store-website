<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCancellationReason extends Model
{
    use HasFactory;

    protected $fillable = ['reason'];

    /**
     * Mối quan hệ: Một lý do hủy có thể liên quan đến nhiều lần hủy đơn hàng.
     */
    public function cancellations()
    {
        return $this->hasMany(OrderCancellation::class, 'reason_id');
    }
}
