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
        Schema::create('post_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('posts')->comment('Bài viết');
            $table->foreignId('user_id')->constrained('users')->comment('Người viết');
            $table->text('content')->comment('Nội dung');
            $table->enum('status', ['published', 'pending', 'spam'])->default('pending')->comment('Trạng thái');
            $table->foreignId('parent_id')->nullable()->constrained('post_comments')->comment('Bình luận cha');
            // $table->integer('likes')->default(0)->comment('Số lượt thích');
            // $table->integer('dislikes')->default(0)->comment('Số lượt không thích');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_comments');
    }
};
