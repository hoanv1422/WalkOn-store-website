<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_variant_id',
        'quantity',
    ];

    /**
     * Get the cart that owns the cart item.
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * Get the product variant associated with the cart item.
     */
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function getPriceAttribute()
    {
        $productVariant = $this->productVariant;

        return ($productVariant->price_sale && $productVariant->price_sale < $productVariant->price)
            ? $productVariant->price_sale * $this->quantity
            : $productVariant->price * $this->quantity;
    }

    /**
     * Get the formatted price.
     */
    public function getFormattedPriceAttribute()
    {
        return $this->price;
    }
}
