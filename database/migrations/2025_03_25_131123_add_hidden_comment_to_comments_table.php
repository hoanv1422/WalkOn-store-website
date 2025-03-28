<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            // Thêm cột 'hidden_comment' kiểu boolean, mặc định là false (không ẩn)
            $table->boolean('hidden_comment')->default(false); 
        });
    }
    
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            // Nếu rollback, xóa cột 'hidden_comment'
            $table->dropColumn('hidden_comment');
        });
    }
    
};
