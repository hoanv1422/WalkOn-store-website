<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Tắt ràng buộc khóa ngoại để tránh lỗi khi xóa dữ liệu cũ
        Schema::disableForeignKeyConstraints();

        // Xóa dữ liệu cũ
        DB::table('post_categories')->truncate();
        DB::table('posts')->truncate();
        DB::table('post_comments')->truncate();




        // Tạo danh mục bài viết
        $categories = ['Công nghệ', 'Thể thao', 'Sức khỏe', 'Giáo dục', 'Giải trí'];
        $categoryIds = [];

        foreach ($categories as $category) {
            $categoryIds[] = DB::table('post_categories')->insertGetId([
                'name'        => $category,
                'slug'        => Str::slug($category),
                'is_active'   => true,
                'description' => 'Mô tả danh mục ' . $category,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        // Tạo bài viết
        $posts = [];
        for ($i = 1; $i <= 10; $i++) {
            $posts[] = [
                'title'        => 'Bài viết số ' . $i,
                'slug'        => Str::slug('Bài viết số ' . $i),
                'content'     => 'Nội dung chi tiết của bài viết số ' . $i,
                'thumbnail'   => 'post' . $i . '.jpg',
                'category_id' => $categoryIds[array_rand($categoryIds)], // Chọn ngẫu nhiên danh mục
                'user_id'     => 1, // Giả sử user_id = 1 là admin
                'status'      => 'published',
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        DB::table('posts')->insert($posts);

        // Tạo bình luận
        $comments = [];
        for ($i = 1; $i <= 20; $i++) {
            $comments[] = [
                'post_id'    => rand(1, 10), // Chọn bài viết ngẫu nhiên
                'user_id'    => rand(1, 5),  // Giả sử có 5 người dùng
                'content'    => 'Bình luận số ' . $i,
                'status'     => 'published',
                'parent_id'  => null, // Không có bình luận cha
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('post_comments')->insert($comments);

        Schema::enableForeignKeyConstraints();
    }
}
