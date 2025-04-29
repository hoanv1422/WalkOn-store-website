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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();

            $table->string('user_email')->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_address')->nullable();
            $table->string('user_phone')->nullable();

            $table->string('receiver_email')->nullable();
            $table->string('receiver_name')->nullable();
            $table->string('receiver_address')->nullable();
            $table->string('receiver_phone')->nullable();
            $table->string('note')->nullable();
            $table->foreignId('coupon_id')->nullable()->constrained('coupons')->nullOnDelete();
            $table->string('coupon')->nullable();
            $table->decimal('total_price', 15, 2);
            $table->decimal('discount_amount', 15, 2)->default(0);
            $table->decimal('shipping_fee', 15, 2)->default(0);
            $table->decimal('final_price', 15, 2);
            $table->enum('order_status', ['pending', 'confirmed', 'processing',   'ready',  'shipped', 'delivered', 'cancelled', 'returned', 'completed'])->default('pending');
            $table->enum('payment_status', ['unpaid', 'paid', 'refunded'])->default('unpaid');
            $table->string('payment_method');
            $table->json('cart_item_ids')->nullable();


            $table->foreignId('courier_id')->nullable()->constrained('couriers')->nullOnDelete();
            $table->timestamp('payment_date')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->string('tracking_code')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
