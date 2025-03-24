<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'start_time',
        'end_time',
        'max_uses',
        'max_uses_per_user',
        'discount_type',
        'discount_value',
        'maximum_discount_amount',
        'minimum_order_value',
        'max_shipping_discount',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * The users who have used this coupon.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'coupon_user')->withPivot('times_used')->withTimestamps();
    }

    /**
     * The categories that this coupon applies to.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'coupon_categories')->withTimestamps();
    }

    /**
     * The brands that this coupon applies to.
     */
    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'coupon_brands')->withTimestamps();
    }

    public static function getDiscountTypeLabels()
    {
        return [
            'percentage' => 'Giảm giá theo phần trăm',
            'fixed' => 'Giảm giá cố định',
            'free_shipping' => 'Miễn phí vận chuyển',
        ];
    }

    /**
     * Accessor để hiển thị discount_type bằng tiếng Việt
     */
    public function getDiscountTypeTextAttribute()
    {
        return self::getDiscountTypeLabels()[$this->discount_type] ?? $this->discount_type;
    }
}


