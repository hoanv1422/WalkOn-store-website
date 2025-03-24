<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Bảng mã giảm giá
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->integer('max_uses')->default(1); // Tổng số lần có thể sử dụng
            $table->integer('max_uses_per_user')->default(1); // Số lần 1 user có thể sử dụng
            $table->enum('discount_type', ['percentage', 'fixed', 'freeship']);
            $table->decimal('discount_value', 20, 2)->nullable(); // Có thể null nếu là freeship
            $table->decimal('minimum_order_value', 20, 2)->default(0);
            $table->decimal('maximum_discount_amount', 20, 2)->nullable()->comment('Số tiền giảm tối đa');
            $table->decimal('max_shipping_discount', 20, 2)->nullable();
            $table->boolean('is_active')->default(true)->comment('Trạng thái');// Giảm giá tối đa cho freeship
            $table->timestamps();
            $table->softDeletes();
        });

        if (!Schema::hasTable('coupon_user')) {
            Schema::create('coupon_user', function (Blueprint $table) {
                $table->id();
                $table->foreignId('coupon_id')->constrained('coupons')->onDelete('cascade');
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->integer('times_used')->default(0);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('coupon_categories')) {
            Schema::create('coupon_categories', function (Blueprint $table) {
                $table->id();
                $table->foreignId('coupon_id')->constrained('coupons')->onDelete('cascade');
                $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('coupon_brands')) {
            Schema::create('coupon_brands', function (Blueprint $table) {
                $table->id();
                $table->foreignId('coupon_id')->constrained('coupons')->onDelete('cascade');
                $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('coupon_brands');
        Schema::dropIfExists('coupon_categories');
        Schema::dropIfExists('coupon_user');
        Schema::dropIfExists('coupons');
    }
};
