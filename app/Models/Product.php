<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'name',
        'slug',
        'description',
        'price_income',
        'price',
        'price_sale',
        'image',
        'quantity',
        'sold_quantity',
        'average_rating',
        'category_id',
        'brand_id',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function galleries()
    {
        return $this->hasMany(ProductGallery::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
    public function colors()
{
    return $this->hasManyThrough(Color::class, ProductVariant::class, 'product_id', 'id', 'id', 'color_id')->distinct();
}

public function sizes()
{
    return $this->hasManyThrough(Size::class, ProductVariant::class, 'product_id', 'id', 'id', 'size_id')->distinct();
}

    
}
