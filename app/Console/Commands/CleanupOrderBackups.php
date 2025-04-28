<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\OrderBackup;

class CleanupOrderBackups extends Command
{
    /**
     * The name and signature of the console command.
     *
     * Ví dụ: bạn có thể truyền tham số retention days (mặc định 14)
     */
    protected $signature = 'order:cleanup-backups {--days=14 : Số ngày giữ bản backup}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Xóa các bản backup đơn hàng cũ hơn số ngày chỉ định';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = $this->option('days');
        $cutoffDate = Carbon::now()->subDays($days);

        $backupsToDelete = OrderBackup::where('created_at', '<', $cutoffDate)->get();
        $count = $backupsToDelete->count();

        if ($count > 0) {
            OrderBackup::where('created_at', '<', $cutoffDate)->delete();
            $this->info("Đã xóa $count bản backup cũ hơn $days ngày.");
        } else {
            $this->info("Không có bản backup nào cũ hơn $days ngày.");
        }

        return 0;
    }
}
