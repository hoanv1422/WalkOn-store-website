<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;
use App\Models\OrderBackup;
use App\Models\User;

class RestoreOrderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * Cú pháp: order:restore {orderId} {backupId?}
     * Nếu không truyền backupId, command sẽ lấy bản backup mới nhất.
     */
    protected $signature = 'order:restore {orderId} {backupId?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Khôi phục dữ liệu đơn hàng từ bản backup';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $orderId = $this->argument('orderId');
        $backupId = $this->argument('backupId');

        // Yêu cầu người dùng nhập mật khẩu admin
        $confirmPassword = $this->ask('Nhập mật khẩu admin để xác nhận thao tác restore');

        // Lấy admin từ DB 
        $admin = User::where('role', 'admin')->first();
        if (!$admin || !Hash::check($confirmPassword, $admin->password)) {
            $this->error('Mật khẩu không đúng. Thao tác restore bị hủy.');
            return 1;
        }

        $order = Order::find($orderId);
        if (!$order) {
            $this->error("Không tìm thấy đơn hàng với ID: {$orderId}");
            return 1;
        }

        if ($backupId) {
            $backup = OrderBackup::where('original_order_id', $orderId)
                ->where('id', $backupId)
                ->first();
            if (!$backup) {
                $this->error("Không tìm thấy bản backup với ID: {$backupId} cho đơn hàng {$orderId}");
                return 1;
            }
        } else {
            $backup = OrderBackup::where('original_order_id', $orderId)
                ->orderBy('created_at', 'desc')
                ->first();
            if (!$backup) {
                $this->error("Không tìm thấy bản backup nào cho đơn hàng {$orderId}");
                return 1;
            }
        }

        $data = json_decode($backup->data, true);
        unset($data['id'], $data['created_at'], $data['updated_at']);

        $order->update($data);

        $this->info("Đơn hàng {$order->order_code} đã được khôi phục thành công từ bản backup.");

        return 0;
    }
}
