<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->integer('city_code')->nullable()->after('city');
            $table->integer('district_code')->nullable()->after('district');
            $table->integer('ward_code')->nullable()->after('ward');
            $table->enum('type', ['HOME', 'OFFICE', 'OTHER'])->default('HOME')->after('address_line');
            $table->boolean('is_default')->default(false)->after('longitude');
        });
    }

    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropColumn(['city_code', 'district_code', 'ward_code', 'type', 'is_default']);
        });
    }
};