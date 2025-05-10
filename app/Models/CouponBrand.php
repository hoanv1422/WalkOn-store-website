<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponBrand extends Model
{
    use HasFactory;

    protected $fillable = ['coupon_id', 'brand_id'];

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
