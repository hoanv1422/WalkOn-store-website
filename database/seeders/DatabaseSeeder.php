<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Brand;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Color;
use App\Models\Order;
use App\Models\OrderItem;
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

        // Xóa dữ liệu cũ để tránh lỗi duplicate
        foreach ([
            Category::class, Brand::class, Size::class, Color::class, Product::class,
            ProductVariant::class, ProductGallery::class, Cart::class, CartItem::class,
            Order::class, OrderItem::class, User::class
        ] as $model) {
            if (Schema::hasTable((new $model)->getTable())) {
                $model::query()->truncate();
            }
        }

        // Tạo dữ liệu mẫu

        // Category
        $categories = ['Sneakers', 'Boots', 'Sandals', 'Loafers', 'Sports Shoes'];
        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => Str::slug($category),
            ]);
        }

        // Brand
        $brands = ['Nike', 'Adidas', 'Puma', 'Reebok', 'New Balance'];
        foreach ($brands as $brand) {
            Brand::create([
                'name' => $brand,
                'slug' => Str::slug($brand),
                'logo' => '',
                'description' => '',
            ]);
        }

        // Color
        $colors = [
            ['name' => 'Red', 'code' => '#FF0000'],
            ['name' => 'Blue', 'code' => '#0000FF'],
            ['name' => 'Green', 'code' => '#008000'],
            ['name' => 'Black', 'code' => '#000000'],
            ['name' => 'White', 'code' => '#FFFFFF'],
        ];
        foreach ($colors as $color) {
            Color::create([
                'color' => $color['name'],
                'slug' => Str::slug($color['name']),
                'code' => $color['code'],
            ]);
        }

        // Size
        $sizes = ['S', 'M', 'L', 'XL', 'XXL'];
        foreach ($sizes as $size) {
            Size::create([
                'size' => $size,
                'slug' => Str::slug($size),
            ]);
        }

        // Product
        $productNames = [
            'Nike Air Max', 'Adidas Ultraboost', 'Puma Suede',
            'Reebok Classic', 'New Balance 574', 'Nike Air Force',
            'Adidas NMD', 'Puma RS-X', 'Reebok Zig'
        ];
        foreach ($productNames as $index => $productName) {
            Product::create([
                'sku' => 'SKU' . ($index + 1),
                'name' => $productName,
                'slug' => Str::slug($productName),
                'description' => 'A great pair of ' . $productName . ' shoes.',
                'price_income' => rand(30, 70),
                'price' => rand(50, 150),
                'price_sale' => rand(40, 140),
                'image' => '',
                'quantity' => rand(10, 100),
                'sold_quantity' => rand(0, 50),
                'average_rating' => rand(0, 50) / 10,
                'category_id' => ($index % 5) + 1,
                'brand_id' => ($index % 5) + 1,
                'is_active' => true,
            ]);
        }

        // Product Variant
        for ($i = 0; $i < 5; $i++) {
            ProductVariant::query()->create([
                'product_id' => rand(1, 5), // ID sản phẩm thực tế
                'size_id'    => rand(1, 4), // ID kích thước
                'color_id'   => rand(1, 4), // ID màu sắc
                'image'      => 'variant' . ($i + 1) . '.jpg', // Ảnh sản phẩm
                'price'      => rand(100000, 500000), // Giá sản phẩm
                'price_sale'      => rand(100000, 500000), // Giá sản phẩm
                'quantity'   => rand(1, 50),
            ]);
        }

        // User
        User::create([
            'username' => 'example_user',
            'name' => 'John Doe',
            'mail' => 'member@gmail.com', 
            'password' =>'123456', 
            'avatar' => 'default-avatar.png',
            'phone' => '0123456789',
            'address' => '123 Main Street',
            'email_verified_at' => now(),
            'role' => 'user',
            'is_active' => true,
        ]);

        User::query()->create([
            'username'          => 'example_admin',
            'name'              => 'John Doe',
            'mail'              => 'admin@gmail.com',
            'password'          => '123456',
            'avatar'            => 'default-avatar.png',
            'phone'             => '0123456789',
            'address'           => '123 Main Street',
            'email_verified_at' => now(),
            'role'              => 'admin',
            'is_active'         => true,
        ]);



        Cart::query()->create([
            'user_id'          => '1',
        ]);

        // Cart Items
        for ($i = 0; $i < 3; $i++) {
            CartItem::query()->create([
                'cart_id'            => 1, // ID giỏ hàng thực tế
                'product_variant_id' => rand(1, 4), // ID biến thể sản phẩm
                'quantity'           => rand(1, 5), // Số lượng ngẫu nhiên
            ]);
        }

        // Order
        Order::create([
            'user_id' => 1,
            'user_email' => 'buyer@example.com',
            'user_name' => 'Nguyễn Văn A',
            'user_address' => '123 Đường ABC, TP.HCM',
            'user_phone' => '0123456789',
            'same_as_buyer' => true,
            'receiver_email' => 'receiver@example.com',
            'receiver_name' => 'Trần Văn B',
            'receiver_address' => '456 Đường XYZ, Hà Nội',
            'receiver_phone' => '0987654321',
            'coupon' => 'DISCOUNT10',
            'order_status' => 'pending',
            'payment_status' => 'unpaid',
            'payment_method' => 'cod',
            'order_code' => Str::uuid(),
            'total_price' => 500000,
        ]);

        // Order Items
        for ($i = 0; $i < 3; $i++) {
            OrderItem::create([
                'order_id' => 1,
                'product_variant_id' => rand(1, 4),
                'product_name' => 'Sản phẩm ' . ($i + 1),
                'product_sku' => 'SKU' . ($i + 1),
                'product_image' => 'product' . ($i + 1) . '.jpg',
                'product_price' => 100000,
                'product_price_sale' => 90000,
                'variant_size_name' => 'M',
                'variant_color_name' => 'Đỏ',
                'quantity' => rand(1, 5),
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}