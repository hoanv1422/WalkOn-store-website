<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_logs', function (Blueprint $table) {
            $table->id();
            $table->string('job_id')->nullable();
            $table->string('job_type');
            $table->string('related_id')->nullable()->comment('ID của model liên quan (VD: order_id)');
            $table->string('action')->comment('Hành động thực hiện');
            $table->text('details')->nullable()->comment('Chi tiết về hành động');
            $table->string('status')->comment('Trạng thái: success, failed, pending');
            $table->integer('attempt')->default(1)->comment('Lần thử');
            $table->timestamps();

            // Index để tìm kiếm nhanh
            $table->index(['job_type', 'related_id']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_logs');
    }
}
