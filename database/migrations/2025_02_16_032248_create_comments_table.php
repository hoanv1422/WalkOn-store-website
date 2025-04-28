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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade')->index();
            $table->text('content');
            $table->decimal('rating', 2, 1)->nullable()->check('rating BETWEEN 1.0 AND 5.0');
            $table->boolean('hidden_comment')->default(false);
            $table->string('last_admin_username')->nullable();
            $table->timestamps();
            $table->softDeletes(); 
        });

        Schema::create('comment_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comment_id')->constrained('comments')->cascadeOnDelete();
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_galleries');
        Schema::dropIfExists('comments');
    }
};
