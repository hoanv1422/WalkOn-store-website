<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\OrderAudit;

class Order extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
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

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function auditsCustom()
    {
        return $this->hasMany(OrderAudit::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::updated(function ($order) {
            // Lấy các trường thay đổi
            $changes = $order->getDirty();
            foreach ($changes as $field => $newValue) {
                OrderAudit::create([
                    'order_id' => $order->id,
                    'field_name' => $field,
                    'old_value' => $order->getOriginal($field),
                    'new_value' => $newValue,
                    'user_id' => auth()->id() ?? $order->user_id,
                ]);
            }
        });
        // Backup khi đơn hàng được cập nhật
        static::updated(function ($order) {
            OrderBackup::create([
                'original_order_id' => $order->id,
                'data' => json_encode($order->getOriginal()), // Lưu dữ liệu gốc trước khi cập nhật
                'reason' => 'Cập nhật thông tin đơn hàng',
                'user_id' => auth()->id(), // Lấy ID người dùng đang đăng nhập
            ]);
        });

        // Backup khi đơn hàng bị xóa
        static::deleted(function ($order) {
            OrderBackup::create([
                'original_order_id' => $order->id,
                'data' => json_encode($order->getOriginal()),
                'reason' => 'Xóa đơn hàng',
                'user_id' => auth()->id(),
            ]);
        });
    }
    public function backups()
    {
        return $this->hasMany(OrderBackup::class, 'original_order_id');
    }
}
