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
        Schema::create('order_backups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('original_order_id')->constrained('orders')->onDelete('cascade'); // Liên kết với bảng orders
            $table->json('data'); // Lưu toàn bộ dữ liệu gốc của đơn hàng dưới dạng JSON
            $table->string('reason')->nullable(); // Lý do backup 
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Người thực hiện backup
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_backups');
    }
};
