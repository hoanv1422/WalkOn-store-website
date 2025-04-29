<?php

namespace App\Jobs;

use App\Models\Courier;
use App\Notifications\NewOrderAssigned;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AutoAssignOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        // Tìm shipper có trạng thái available
        $availableShipper = Courier::query()->where('status', 'active') // Có thể thay thế bằng thuật toán phân phối khác
            ->first();

        if ($availableShipper) {
            // Gán shipper cho đơn hàng
            $this->order->courier_id = $availableShipper->id;
            $this->order->save();

            // Cập nhật trạng thái shipper thành busy
            // $availableShipper->status = 'busy';
            // $availableShipper->save();

            // Gửi thông báo cho shipper
            // $this->notifyShipper($availableShipper, $this->order);
        } else {
            // Nếu không có shipper available, đặt lại vào hàng đợi sau 5 phút
            Log::warning('No available shipper, releasing job', ['order_id' => $this->order->id]);
            $this->release(10);

        }
    }

    // protected function notifyShipper($shipper, $order)
    // {
    //     // Gửi notification qua các kênh như: email, sms, push notification...
    //     // Ví dụ với Notification:
    //     $shipper->notify(new NewOrderAssigned($order));
    // }
}
