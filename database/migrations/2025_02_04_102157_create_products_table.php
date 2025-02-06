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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->unique()->comment('Mã sản phẩm');
            $table->string('name')->comment('Tên sản phẩm');
            $table->string('slug')->unique()->comment('URL thân thiện');
            $table->text('description')->nullable()->comment('Mô tả sản phẩm');
            $table->decimal('price_income', 15, 2)->comment('Giá nhập vào');
            $table->decimal('price', 15, 2)->comment('Giá cơ bản');
            $table->decimal('price_sale', 15, 2)->nullable()->comment('Giá khuyến mãi');
            $table->string('image')->nullable()->comment('Hình ảnh sản phẩm');
            $table->integer('quantity')->default(0)->comment('Số lượng tồn kho');
            $table->integer('sold_quantity')->default(0)->comment('Số lượng đã bán');
            $table->decimal('average_rating', 3, 1)->default(0)->comment('Đánh giá trung bình');
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('brand_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_active')->default(true)->comment('Trạng thái sản phẩm');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
