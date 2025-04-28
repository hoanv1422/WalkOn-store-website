<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
        'view_count',
        'brand_id',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getRouteKeyName()
    {
        return 'slug'; // Laravel sẽ tự động tìm theo 'slug' thay vì 'id'
    }

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
        return $this->belongsToMany(Color::class, 'product_variants', 'product_id', 'color_id')->distinct();
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_variants', 'product_id', 'size_id')->distinct();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function relatedProducts()
    {

        $relatedProducts = Product::where('id', '!=', $this->id)
            ->where(function ($query) {
                $query->where('category_id', $this->category_id)
                    ->orWhere('brand_id', $this->brand_id);
            })
            ->inRandomOrder()
            ->take(8)
            ->with('variants')
            ->get();


        if ($relatedProducts->count() < 8) {
            $additionalCount = 8 - $relatedProducts->count();
            $additionalProducts = Product::where('id', '!=', $this->id)
                ->whereNotIn('id', $relatedProducts->pluck('id'))
                ->inRandomOrder()
                ->take($additionalCount)
                ->with('variants')
                ->get();

            // Merge the collections
            $relatedProducts = $relatedProducts->merge($additionalProducts);
        }

        $relatedProducts->transform(function ($product) {
            if ($product->variants->first()->image && Storage::exists($product->variants->first()->image)) {
                $product->secondary_image = Storage::url($product->variants->first()->image);
            } else {
                $product->secondary_image = asset('/img/default-image.jpg');
            }

            if ($product->image && Storage::exists($product->image)) {
                $product->image = Storage::url($product->image);
            } else {
                $product->image = asset('/img/default-image.jpg');
            }
            return $product;
        });




        return $relatedProducts;
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
}
