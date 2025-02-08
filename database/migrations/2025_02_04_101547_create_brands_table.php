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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Tên thương hiệu');
            $table->string('slug')->unique()->comment('URL thân thiện');
            $table->string('logo')->nullable()->comment('Logo thương hiệu');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true)->comment('Trạng thái');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
