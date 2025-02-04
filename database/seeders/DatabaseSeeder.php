<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\ProductVariant;
use App\Models\Size;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Category::query()->truncate();
        Brand::query()->truncate();
        Size::query()->truncate();
        Color::query()->truncate();
        Product::query()->truncate();
        ProductVariant::query()->truncate();
        ProductGallery::query()->truncate();



        // Category
        $categories = ['Sneakers', 'Boots', 'Sandals', 'Loafers', 'Sports Shoes'];
        for ($i = 0; $i < 5; $i++) {
            Category::query()->create([
                'name' => $categories[$i],
                'slug' => Str::slug($categories[$i]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        // Brand
        $brands = ['Nike', 'Adidas', 'Puma', 'Reebok', 'New Balance'];
        for ($i = 0; $i < 5; $i++) {
            Brand::query()->create([
                'name' => $brands[$i],
                'slug' => Str::slug($brands[$i]),
                'logo' => '',
                'description' => '',    
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Color
        $colors = ['Red', 'Blue', 'Green', 'Black', 'White'];
        for ($i = 0; $i < 5; $i++) {
            Color::query()->create([
                'color' => $colors[$i],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Size
        $sizes = ['S', 'M', 'L', 'XL', 'XXL'];
        for ($i = 0; $i < 5; $i++) {
            Size::query()->create([
                'size' => $sizes[$i],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


    }
}
