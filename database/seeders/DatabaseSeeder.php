<?php

namespace Database\Seeders;

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
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        User::query()->truncate();
        Size::query()->truncate();
        Color::query()->truncate();
        Category::query()->truncate();
        Brand::query()->truncate();
        Product::query()->truncate();
        ProductVariant::query()->truncate();
        ProductGallery::query()->truncate();



        // User
        $roles = ['user', 'admin', 'shipper'];

        foreach ($roles as $i => $role) {
            User::create([
                'username' => $role,
                'name' => ucfirst($role) . ' Account',
                'email' => $role . '@gmail.com',
                'password' => Hash::make('123456'),
                'avatar' => 'avatars/default.png',
                'phone' => '090000000' . ($i + 1),
                'email_verified_at' => null,
                'role' => $role,
                'is_active' => true,
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


        // Color
        $colors = [
            ['color' => 'Đỏ', 'code' => '#FF0000'],
            ['color' => 'Xanh lá', 'code' => '#00FF00'],
            ['color' => 'Xanh dương', 'code' => '#0000FF'],
            ['color' => 'Vàng', 'code' => '#FFFF00'],
            ['color' => 'Đen', 'code' => '#000000'],
        ];

        foreach ($colors as $item) {
            Color::create([
                'color' => $item['color'],
                'slug' => Str::slug($item['color']),
                'code' => $item['code'],
            ]);
        }

        // Category
        $categories = [
            'Áo',
            'Quần',
            'Giày',
            'Phụ kiện',
            'Khuyến mãi',
        ];

        foreach ($categories as $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'is_active' => true,
            ]);
        }

        // Brand
        $brands = [
            [
                'name' => 'Nike',
                'logo' => 'brands/nike.png',
                'description' => 'Thương hiệu thể thao nổi tiếng toàn cầu.',
            ],
            [
                'name' => 'Adidas',
                'logo' => 'brands/adidas.png',
                'description' => 'Đối thủ cạnh tranh chính của Nike.',
            ],
            [
                'name' => 'Puma',
                'logo' => 'brands/puma.png',
                'description' => 'Phong cách thể thao trẻ trung và năng động.',
            ],
            [
                'name' => 'Converse',
                'logo' => 'brands/converse.png',
                'description' => 'Nổi bật với giày vải cổ điển.',
            ],
            [
                'name' => 'New Balance',
                'logo' => 'brands/new-balance.png',
                'description' => 'Giày thể thao chất lượng cao, nổi bật với sự thoải mái.',
            ],
        ];

        foreach ($brands as $brand) {
            Brand::create([
                'name' => $brand['name'],
                'slug' => Str::slug($brand['name']),
                'logo' => $brand['logo'],
                'description' => $brand['description'],
                'is_active' => true,
            ]);
        }

        // Product
        $products = [
            [
                'name' => 'Giày thể thao Nike Air Max',
                'price_income' => 1200000,
                'price' => 1500000,
                'price_sale' => 1350000,
                'image' => 'products/nike-air-max.jpg',
                'quantity' => 100,
                'sold_quantity' => 20,
                'average_rating' => 4.5,
                'category_id' => 1,
                'brand_id' => 1,
                'view_count' => 350,
            ],
            [
                'name' => 'Áo thun Adidas Originals',
                'price_income' => 200000,
                'price' => 350000,
                'price_sale' => 300000,
                'image' => 'products/adidas-shirt.jpg',
                'quantity' => 80,
                'sold_quantity' => 30,
                'average_rating' => 4.2,
                'category_id' => 2,
                'brand_id' => 2,
                'view_count' => 120,
            ],
            [
                'name' => 'Quần short Puma Active',
                'price_income' => 180000,
                'price' => 250000,
                'price_sale' => 220000,
                'image' => 'products/puma-shorts.jpg',
                'quantity' => 60,
                'sold_quantity' => 10,
                'average_rating' => 4.0,
                'category_id' => 2,
                'brand_id' => 3,
                'view_count' => 90,
            ],
            [
                'name' => 'Giày Converse cổ cao',
                'price_income' => 700000,
                'price' => 1000000,
                'price_sale' => 950000,
                'image' => 'products/converse-high.jpg',
                'quantity' => 40,
                'sold_quantity' => 15,
                'average_rating' => 4.3,
                'category_id' => 1,
                'brand_id' => 4,
                'view_count' => 200,
            ],
            [
                'name' => 'Áo hoodie New Balance',
                'price_income' => 450000,
                'price' => 600000,
                'price_sale' => 550000,
                'image' => 'products/nb-hoodie.jpg',
                'quantity' => 30,
                'sold_quantity' => 5,
                'average_rating' => 4.1,
                'category_id' => 2,
                'brand_id' => 5,
                'view_count' => 70,
            ],
            [
                'name' => 'Mũ lưỡi trai Nike',
                'price_income' => 100000,
                'price' => 180000,
                'price_sale' => 150000,
                'image' => 'products/nike-cap.jpg',
                'quantity' => 50,
                'sold_quantity' => 12,
                'average_rating' => 4.4,
                'category_id' => 3,
                'brand_id' => 1,
                'view_count' => 60,
            ],
            [
                'name' => 'Balo Adidas Street',
                'price_income' => 350000,
                'price' => 500000,
                'price_sale' => 450000,
                'image' => 'products/adidas-backpack.jpg',
                'quantity' => 40,
                'sold_quantity' => 18,
                'average_rating' => 4.6,
                'category_id' => 4,
                'brand_id' => 2,
                'view_count' => 150,
            ],
            [
                'name' => 'Quần jogger Puma Lifestyle',
                'price_income' => 250000,
                'price' => 400000,
                'price_sale' => 360000,
                'image' => 'products/puma-joggers.jpg',
                'quantity' => 70,
                'sold_quantity' => 25,
                'average_rating' => 4.2,
                'category_id' => 2,
                'brand_id' => 3,
                'view_count' => 110,
            ],
            [
                'name' => 'Áo khoác Converse Windbreaker',
                'price_income' => 500000,
                'price' => 750000,
                'price_sale' => 700000,
                'image' => 'products/converse-jacket.jpg',
                'quantity' => 35,
                'sold_quantity' => 8,
                'average_rating' => 4.0,
                'category_id' => 2,
                'brand_id' => 4,
                'view_count' => 85,
            ],
            [
                'name' => 'Giày chạy bộ New Balance 520',
                'price_income' => 900000,
                'price' => 1200000,
                'price_sale' => 1100000,
                'image' => 'products/nb-running-shoes.jpg',
                'quantity' => 45,
                'sold_quantity' => 19,
                'average_rating' => 4.7,
                'category_id' => 1,
                'brand_id' => 5,
                'view_count' => 250,
            ],
        ];

        foreach ($products as $index => $product) {
            Product::create([
                'sku' => 'SP' . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                'name' => $product['name'],
                'slug' => Str::slug($product['name']),
                'description' => 'Mô tả sản phẩm: ' . $product['name'],
                'price_income' => $product['price_income'],
                'price' => $product['price'],
                'price_sale' => $product['price_sale'],
                'image' => $product['image'],
                'quantity' => $product['quantity'],
                'sold_quantity' => $product['sold_quantity'],
                'average_rating' => $product['average_rating'],
                'category_id' => $product['category_id'],
                'view_count' => $product['view_count'],
                'brand_id' => $product['brand_id'],
                'is_active' => true,
            ]);
        }


        // Product Variant
        $products = DB::table('products')->pluck('id');
        $sizes = DB::table('sizes')->pluck('id');
        $colors = DB::table('colors')->pluck('id');

        foreach ($products as $productId) {
            foreach ($sizes as $sizeId) {
                foreach ($colors as $colorId) {
                    ProductVariant::create([
                        'product_id' => $productId,
                        'size_id' => $sizeId,
                        'color_id' => $colorId,
                        'image' => 'variants/variant-' . $productId . '-' . $sizeId . '-' . $colorId . '.jpg',
                        'price' => rand(200000, 500000),
                        'price_sale' => rand(180000, 450000),
                        'quantity' => rand(5, 50),
                    ]);
                }
            }
        }

        // Product Gallery
        $products = DB::table('products')->pluck('id');

        foreach ($products as $productId) {
            for ($i = 1; $i <= 3; $i++) {
                ProductGallery::create([
                    'product_id' => $productId,
                    'image' => "galleries/product-{$productId}-{$i}.jpg",
                ]);
            }
        }



        Schema::enableForeignKeyConstraints();
    }
}
