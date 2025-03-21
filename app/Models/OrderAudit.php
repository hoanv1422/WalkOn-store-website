<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAudit extends Model
{
    use HasFactory;
    protected $table = 'order_audits';
    protected $fillable = ['order_id', 'field_name', 'old_value', 'new_value', 'user_id'];
    // app/Models/Order.php
protected static function boot()
{
    parent::boot();

    static::updated(function ($order) {
        foreach ($order->getDirty() as $field => $newValue) {
            OrderAudit::create([
                'order_id' => $order->id,
                'field_name' => $field,
                'old_value' => $order->getOriginal($field),
                'new_value' => $newValue,
                'user_id' => auth()->id(),
            ]);
        }
    });
}
}
