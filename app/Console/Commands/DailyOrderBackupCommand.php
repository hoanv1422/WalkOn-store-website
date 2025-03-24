<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderBackup;
use Illuminate\Console\Command;

class DailyOrderBackupCommand extends Command
{
/**
     * The name and signature of the console command.
     *
     * Sử dụng lệnh: php artisan backup:orders-daily
     */
    protected $signature = 'backup:orders-daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tạo backup toàn bộ đơn hàng hàng ngày';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Lấy tất cả các đơn hàng
        $orders = Order::all();
        $count = 0;

        foreach ($orders as $order) {
            // Tạo bản backup cho từng đơn hàng
            OrderBackup::create([
                'original_order_id' => $order->id,
                // Sử dụng toArray() để lấy toàn bộ dữ liệu của đơn hàng
                'data' => json_encode($order->toArray()),
                'reason' => 'Backup hàng ngày vào ' . Carbon::now()->toDateTimeString(),
                // Nếu không có người thực hiện cụ thể, có thể để null hoặc gán một admin id cố định
                'user_id' => null,
            ]);
            $count++;
        }

        $this->info("Backup hàng ngày đã tạo thành công cho {$count} đơn hàng.");
        return 0;
    }
}
