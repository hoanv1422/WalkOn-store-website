<?php

namespace App\Listeners;

use App\Events\OrderStatusChanged;
use App\Jobs\AutoAssignOrderJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AssignOrderToShipper
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderStatusChanged $event)
    {
        $order = $event->order;

        // Kiểm tra nếu đơn hàng đã chuẩn bị xong và chưa có shipper
        if ($order->order_status === 'ready' && is_null($order->courier_id)) {
            AutoAssignOrderJob::dispatch($order);
        }
    }
}
