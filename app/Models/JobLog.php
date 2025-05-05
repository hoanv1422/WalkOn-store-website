<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'job_type',
        'related_id',
        'action',
        'details',
        'status',
        'attempt'
    ];

    protected $casts = [
        'details' => 'array',
    ];

    /**
     * Tạo một bản ghi log mới
     *
     * @param string $jobType Loại job
     * @param string|int $relatedId ID của model liên quan
     * @param string $action Hành động thực hiện
     * @param array $details Chi tiết bổ sung
     * @param string $status Trạng thái: success, failed, pending
     * @param int $attempt Lần thử
     * @return JobLog
     */
    public static function createLog($jobType, $relatedId, $action, $details = [], $status = 'pending', $attempt = 1)
    {
        return self::create([
            'job_id' => app('queue')->getConnectionName() . ':' . uniqid(),
            'job_type' => $jobType,
            'related_id' => $relatedId,
            'action' => $action,
            'details' => $details,
            'status' => $status,
            'attempt' => $attempt
        ]);
    }

    /**
     * Cập nhật trạng thái của một log
     *
     * @param string $status Trạng thái mới
     * @param array $details Chi tiết bổ sung
     * @return bool
     */
    public function updateStatus($status, $details = [])
    {
        $this->status = $status;

        if (!empty($details)) {
            $currentDetails = $this->details ?? [];
            $this->details = array_merge($currentDetails, $details);
        }

        return $this->save();
    }
}
