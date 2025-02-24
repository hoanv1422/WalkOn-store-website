<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Tên bài viết');
            $table->string('slug')->unique()->comment('URL thân thiện');
            $table->text('content')->comment('Nội dung');
            $table->string('thumbnail')->nullable()->comment('Ảnh đại diện');
            $table->foreignId('category_id')->nullable()->constrained('post_categories')->nullOnDelete()->comment('Danh mục bài viết');
            $table->foreignId('user_id')->constrained('users')->comment('Người viết');
            $table->enum('status', ['published', 'draft', 'pending'])->default('draft')->comment('Trạng thái');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
