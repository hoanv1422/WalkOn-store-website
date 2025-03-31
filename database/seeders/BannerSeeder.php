<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run()
    {
        Banner::truncate();
        Banner::insert([
            [
                'title' => 'Nike Air Max 2000',
                'image_url' => 'banners/banner-1.jpg',
                'link' => 'https://example.com/product/1',
                'position' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Adidas Ultra Boost',
                'image_url' => 'banners/banner-2.jpg',
                'link' => 'https://example.com/product/2',
                'position' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Adidas Ultra Boost',
                'image_url' => 'banners/banner-1.jpg',
                'link' => 'https://example.com/product/2',
                'position' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Adidas Ultra Boost',
                'image_url' => '',
                'link' => 'https://example.com/product/2',
                'position' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Adidas Ultra Boost 123',
                'image_url' => 'banners/banner-3.jpg',
                'link' => 'https://example.com/product/2',
                'position' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Adidas Ultra Boost',
                'image_url' => 'banners/banner-4.jpg',
                'link' => 'https://example.com/product/2',
                'position' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'khuyen mai',
                'image_url' => 'banners/banner-10.jpg',
                'link' => 'http://walkon-store-website.test/',
                'position' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'thuong hieu noi tieng',
                'image_url' => 'banners/banner-5.jpg',
                'link' => 'http://walkon-store-website.test/',
                'position' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => ' banner trang shop',
                'image_url' => 'banners/banner.jpg',
                'link' => 'http://walkon-store-website.test/',
                'position' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => ' slider',
                'image_url' => 'banners/slider-1.jpg',
                'link' => 'http://walkon-store-website.test/',
                'position' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => ' slider',
                'image_url' => 'banners/slider-2.jpg',
                'link' => 'http://walkon-store-website.test/',
                'position' => 11,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
