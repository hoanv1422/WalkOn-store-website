<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatusHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'old_status',
        'new_status',
        'changed_by_id',
        'note',
        'changed_at'
    ];

    protected $dates = ['changed_at'];

    /**
     * Mối quan hệ: Lịch sử thay đổi trạng thái thuộc về một đơn hàng.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Mối quan hệ: Người thay đổi trạng thái đơn hàng.
     */
    public function changedBy()
    {
        return $this->belongsTo(User::class, 'changed_by_id');
    }
}
