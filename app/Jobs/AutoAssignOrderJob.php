<?php

namespace App\Jobs;

use App\Models\Courier;
use App\Models\Order;
use App\Models\JobLog;
use App\Notifications\NewOrderAssigned;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AutoAssignOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $orderId;

    public function __construct($order)
    {
        $this->orderId = $order->id;
    }

    public function handle()
    {
        // Tạo log bắt đầu
        $jobLog = JobLog::createLog(
            'AutoAssignOrderJob',
            $this->orderId,
            'job_started',
            [
                'job_id' => $this->job->getJobId(),
                'attempt' => $this->attempts()
            ],
            'processing',
            $this->attempts()
        );

        // Ghi log vào file
        Log::info('Bắt đầu tìm courier cho đơn hàng', [
            'order_id' => $this->orderId,
            'attempt' => $this->attempts(),
            'job_id' => $this->job->getJobId()
        ]);

        // Lấy thông tin đơn hàng từ database
        $order = Order::find($this->orderId);

        // Kiểm tra xem đơn hàng có tồn tại không
        if (!$order) {
            Log::error('Không tìm thấy đơn hàng', ['order_id' => $this->orderId]);
            $jobLog->updateStatus('failed', ['reason' => 'Không tìm thấy đơn hàng']);
            return;
        }

        // Kiểm tra xem đơn hàng đã được gán courier chưa
        if ($order->courier_id) {
            Log::info('Đơn hàng đã được gán courier trước đó', [
                'order_id' => $order->id,
                'courier_id' => $order->courier_id
            ]);
            $jobLog->updateStatus('success', [
                'reason' => 'Đơn hàng đã được gán courier trước đó',
                'courier_id' => $order->courier_id
            ]);
            return;
        }

        // Khóa dòng courier để đảm bảo không có race condition
        DB::beginTransaction();
        try {
            $jobLog->updateStatus('processing', ['step' => 'finding_courier']);

            $availableShipper = Courier::query()
                ->where('status', 'active')
                ->lockForUpdate() // Khóa dòng để tránh đồng thời gán cùng shipper cho nhiều đơn
                ->first();

            if ($availableShipper) {
                // Tìm thấy shipper, xử lý đơn hàng
                $order->courier_id = $availableShipper->id;
                $order->save();

                // Gửi thông báo cho shipper nếu cần
                // $availableShipper->notify(new NewOrderAssigned($order));

                Log::info('Đã gán courier thành công', [
                    'order_id' => $order->id,
                    'courier_id' => $availableShipper->id
                ]);

                $jobLog->updateStatus('success', [
                    'courier_id' => $availableShipper->id,
                    'completed_at' => now()->toDateTimeString()
                ]);

                DB::commit();
            } else {
                DB::rollBack();

                // Tăng thời gian delay lên để tránh retry quá nhanh
                $delayInSeconds = 60; // 1 phút

                Log::warning('Không có courier khả dụng, đang release job để thử lại sau ' . $delayInSeconds . ' giây', [
                    'order_id' => $this->orderId,
                    'attempt' => $this->attempts(),
                    'next_attempt_at' => now()->addSeconds($delayInSeconds)->toDateTimeString()
                ]);

                $jobLog->updateStatus('pending', [
                    'reason' => 'Không có courier khả dụng',
                    'released' => true,
                    'delay' => $delayInSeconds,
                    'next_attempt_at' => now()->addSeconds($delayInSeconds)->toDateTimeString()
                ]);

                $this->release($delayInSeconds);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Lỗi khi gán courier', [
                'order_id' => $this->orderId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            $jobLog->updateStatus('failed', [
                'error' => $e->getMessage(),
                'trace' => substr($e->getTraceAsString(), 0, 500) // Giới hạn độ dài trace
            ]);

            throw $e;
        }
    }

    public function failed(\Throwable $exception)
    {
        JobLog::createLog(
            'AutoAssignOrderJob',
            $this->orderId,
            'job_failed',
            [
                'error' => $exception->getMessage(),
                'trace' => substr($exception->getTraceAsString(), 0, 500)
            ],
            'failed',
            $this->attempts()
        );

        Log::error('Job xử lý đơn hàng thất bại', [
            'order_id' => $this->orderId,
            'exception' => $exception->getMessage()
        ]);
    }
}
