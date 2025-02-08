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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique()->comment('Tên đăng nhập');
            $table->string('password')->comment('Mật khẩu');
            $table->string('name')->comment('Tên người dùng');
            $table->string('mail')->unique()->nullable()->comment('Email');
            $table->string('avatar')->nullable()->comment('Ảnh đại diện');
            $table->string('phone')->nullable()->comment('Số điện thoại');
            $table->text('address')->nullable()->comment('Địa chỉ');
            $table->timestamp('email_verified_at')->nullable()->comment('Thời gian xác nhận email');
            $table->string('role')->comment('Vai trò');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
