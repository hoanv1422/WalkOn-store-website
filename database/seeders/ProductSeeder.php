<?php

namespace Database\Seeders;

use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $product = Product::create([
            'sku'            => 'SP001',
            'name'           => 'Giày Sneaker Nam',
            'slug'           => 'giay-sneaker-nam',
            'description'    => 'Giày sneaker phong cách thể thao, phù hợp với mọi lứa tuổi.',
            'price_income'   => 500000,
            'price'          => 700000,
            'price_sale'     => 650000,
            'image'          => 'images/products/sneaker.jpg',
            'quantity'       => 100,
            'sold_quantity'  => 10,
            'average_rating' => 4.5,
            'category_id'    => 1,
            'brand_id'       => 1,
            'is_active'      => true,
        ]);

        // Tạo danh sách màu sắc nếu chưa có
        $colors = ['Đen', 'Trắng', 'Xanh'];
        foreach ($colors as $colorName) {
            $color = Color::firstOrCreate(['color' => $colorName]);
        }

        // Tạo danh sách kích thước nếu chưa có
        $sizes = ['39', '40', '41', '42'];
        foreach ($sizes as $sizeName) {
            $size = Size::firstOrCreate(['size' => $sizeName]);
        }

        // Tạo biến thể sản phẩm (kết hợp màu và size)
        foreach (Color::all() as $color) {
            foreach (Size::all() as $size) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'color_id'   => $color->id,
                    'size_id'    => $size->id,
                    'image'      => 'images/products/sneaker-' . strtolower($color->name) . '.jpg',
                    'price'      => $product->price + rand(10000, 50000),
                    'quantity'   => rand(10, 50),
                ]);
            }
        }

        // Thêm hình ảnh sản phẩm
        ProductGallery::create([
            'product_id' => $product->id,
            'image'      => 'images/products/gallery1.jpg',
        ]);
        ProductGallery::create([
            'product_id' => $product->id,
            'image'      => 'images/products/gallery2.jpg',
        ]);
        
    }
}
