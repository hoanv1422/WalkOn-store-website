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
use App\Models\User;
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

<<<<<<< HEAD
        //User
        // for ($i = 0; $i < 5; $i++) {
        //     User::create([
        //         'username'          => 'user' . ($i + 1),
        //         'name'              => 'User ' . ($i + 1),
        //         'mail'             => 'user' . ($i + 1) . '@example.com',
        //         'password'          => 123456,
        //         'avatar'            => 'https://i.pravatar.cc/150?img=' . ($i + 1), // Ảnh avatar giả
        //         'phone'             => '09876543' . $i,
        //         'address'           => 'Address ' . ($i + 1),
        //         'email_verified_at' => null,
        //         'role'              => $i % 2 == 0 ? 'admin' : 'user', // Xen kẽ giữa admin và user
        //         'is_active'         => $i % 2 == 0, // Xen kẽ true/false
        //         'created_at'        => now(),
        //         'updated_at'        => now(),
        //     ]);
        // }

=======
        // Product
        $productNames = ['Nike Air Max', 'Adidas Ultraboost', 'Puma Suede', 'Reebok Classic', 'New Balance 574', 'Nike Air Force', 'Adidas NMD', 'Puma RS-X', 'Reebok Zig'];
        for ($i = 0; $i < 9; $i++) {
            Product::query()->create([
                'sku' => 'SKU' . ($i + 1),
                'name' => $productNames[$i],
                'slug' => Str::slug($productNames[$i]),
                'description' => 'A great pair of ' . $productNames[$i] . ' shoes.',
                'price_income' => rand(30, 70),
                'price' => rand(50, 150),
                'price_sale' => rand(40, 140),
                'image' => '',
                'quantity' => rand(10, 100),
                'sold_quantity' => rand(0, 50),
                'average_rating' => rand(0, 50) / 10,
                'category_id' => ($i % 5) + 1,
                'brand_id' => ($i % 5) + 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
>>>>>>> hoang_dev

        Schema::enableForeignKeyConstraints();
    }
}