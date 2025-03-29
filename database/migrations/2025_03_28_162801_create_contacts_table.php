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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('contact_code')->unique()->comment("Mã phản hồi");
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('name')->comment('Tên người dùng');
            $table->string('email')->comment('Email người dùng');
            $table->string('phone')->comment('Số điện thoại');
            $table->text('message')->comment('Nội dung tin nhắn');
            $table->enum("status", ["UNREAD", "READ", "REPLIED"])->default("UNREAD");
            $table->text('response_message')->nullable()->comment('Nội dung phản hồi');
            $table->foreignId('responded_by')->nullable()->constrained('users')->nullOnDelete()->comment('Người phản hồi');

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
