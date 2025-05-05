<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemNotification extends Model
{

    use HasFactory;
    
    protected $fillable = [
        'notifiable_type',
        'notifiable_id',
        'subject_type',
        'subject_id',
        'type',
        'title',
        'message',
        'data',
        'action_url',
        'action_text',
        'is_read',
        'read_at',
        'priority',
        'channels_sent'
    ];

    protected $casts = [
        'data' => 'array',
        'is_read' => 'boolean',
        'read_at' => 'datetime',
        'channels_sent' => 'array'
    ];

    // Đối tượng nhận thông báo (Shipper, User, Admin...)
    public function notifiable()
    {
        return $this->morphTo();
    }

    // Đối tượng liên quan đến thông báo (Order, Payment...)
    public function subject()
    {
        return $this->morphTo();
    }

    // Đánh dấu thông báo đã đọc
    public function markAsRead()
    {
        $this->is_read = true;
        $this->read_at = now();
        $this->save();

        return $this;
    }

    // Phương thức scope để lấy thông báo chưa đọc
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    // Phương thức scope để lọc theo loại thông báo
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Phương thức scope để lọc theo mức độ ưu tiên
    public function scopeWithPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }
}
