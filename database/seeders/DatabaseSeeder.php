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

        Category::query()->truncate();
        Brand::query()->truncate();
        Size::query()->truncate();
        Color::query()->truncate();
        Product::query()->truncate();
        ProductVariant::query()->truncate();
        ProductGallery::query()->truncate();
        Cart::query()->truncate();
        CartItem::query()->truncate();
        Order::query()->truncate();
        OrderItem::query()->truncate();
        User::query()->truncate();



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
                'slug' => Str::slug($colors[$i]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Size
        $sizes = ['S', 'M', 'L', 'XL', 'XXL'];
        for ($i = 0; $i < 5; $i++) {
            Size::query()->create([
                'size' => $sizes[$i],
                'slug' => Str::slug($sizes[$i]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

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

        for ($i = 0; $i < 5; $i++) {
            ProductVariant::query()->create([
                'product_id' => rand(1, 5), // ID sản phẩm thực tế
                'size_id'    => rand(1, 4), // ID kích thước
                'color_id'   => rand(1, 4), // ID màu sắc
                'image'      => 'variant' . ($i + 1) . '.jpg', // Ảnh sản phẩm
                'price'      => rand(100000, 500000), // Giá sản phẩm
                'quantity'   => rand(1, 50),
            ]);
        }


        User::query()->create([
            'username'          => 'example_user',
            'name'              => 'John Doe',
            'mail'              => 'member@gmail.com',
            'password'          => '123456', // Nên hash mật khẩu
            'avatar'            => 'default-avatar.png',
            'phone'             => '0123456789',
            'address'           => '123 Main Street',
            'email_verified_at' => now(),
            'role'              => 'user',
            'is_active'         => true,
        ]);

        Cart::query()->create([
            'user_id'          => '1',
        ]);

        for ($i = 0; $i < 3; $i++) {
            CartItem::query()->create([
                'cart_id'            => 1, // ID giỏ hàng thực tế
                'product_variant_id' => rand(1, 4), // ID biến thể sản phẩm
                'quantity'           => rand(1, 5), // Số lượng ngẫu nhiên
                'price'              => 100000, // Giá sản phẩm
            ]);
        }

        Order::query()->create([
            'user_id'         => 1, // ID của người dùng
            'user_email'      => 'buyer@example.com',
            'user_name'       => 'Nguyễn Văn A',
            'user_address'    => '123 Đường ABC, TP.HCM',
            'user_phone'      => '0123456789',
            'same_as_buyer'   => true, // Nếu địa chỉ người nhận giống người mua
            'receiver_email'  => 'receiver@example.com',
            'receiver_name'   => 'Trần Văn B',
            'receiver_address' => '456 Đường XYZ, Hà Nội',
            'receiver_phone'  => '0987654321',
            'coupon'         => 'DISCOUNT10', // Mã giảm giá (nếu có)
            'order_status'    => 'pending', // Trạng thái đơn hàng: pending, processing, completed...
            'payment_status'  => 'unpaid', // Trạng thái thanh toán: unpaid, paid...
            'payment_method'  => 'cod', // Phương thức thanh toán: cod, credit_card, paypal...
            'order_code'      => Str::uuid(), // Bổ sung giá trị order_code
            'total_price'     => 500000, // Tổng giá trị đơn hàng
        ]);

        for ($i = 0; $i < 3; $i++) {
            OrderItem::query()->create([
                'order_id'           => 1, // ID đơn hàng thực tế
                'product_variant_id' => rand(1, 4), // ID biến thể sản phẩm
                'product_name'       => 'Sản phẩm ' . ($i + 1),
                'product_sku'        => 'SKU' . ($i + 1),
                'product_image'      => 'product' . ($i + 1) . '.jpg',
                'product_price'      => 100000, // Giá gốc
                'product_price_sale' => 90000, // Giá khuyến mãi (nếu có)
                'variant_size_name'  => 'M', // Kích thước sản phẩm
                'variant_color_name' => 'Đỏ', // Màu sắc sản phẩm
                'quantity'           => rand(1, 5), // Số lượng ngẫu nhiên
            ]);
        }





        Schema::enableForeignKeyConstraints();
    }
}