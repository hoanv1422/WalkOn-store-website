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
        Schema::create('system_notifications', function (Blueprint $table) {
            $table->id();
            // Polymorphic relationship cho đối tượng nhận thông báo (shipper, khách hàng, admin...)
            $table->morphs('notifiable');

            // Polymorphic relationship cho đối tượng tạo ra thông báo (đơn hàng, thanh toán...)
            $table->nullableMorphs('subject');

            // Loại thông báo
            $table->string('type');

            // Nội dung thông báo
            $table->string('title');
            $table->text('message');

            // Dữ liệu bổ sung (JSON)
            $table->json('data')->nullable();

            // URL hành động
            $table->string('action_url')->nullable();
            $table->string('action_text')->nullable();

            // Trạng thái thông báo
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();

            // Mức độ ưu tiên
            $table->enum('priority', ['low', 'normal', 'high'])->default('normal');

            // Kênh thông báo đã gửi
            $table->json('channels_sent')->nullable(); // ['database', 'mail', 'sms', 'push']

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_notifications');
    }
};
