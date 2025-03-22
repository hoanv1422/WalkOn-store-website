<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderBackup extends Model
{
    use HasFactory;
    protected $table = 'order_backups';

    protected $fillable = [
        'original_order_id',
        'data',
        'reason',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
