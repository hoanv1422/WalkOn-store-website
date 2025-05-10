<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_variant_id',
        'product_name',
        'product_sku',
        'product_image',
        'product_price',
        'product_price_sale',
        'variant_size_name',
        'variant_color_name',
        'quantity',
    ];

    /**
     * Get the order that owns the order item.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the product variant associated with the order item.
     */
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
   

    public function product()
    {
    return $this->belongsTo(Product::class);
    }

}
