<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAudit extends Model
{
    use HasFactory;
    protected $auditExclude = ['updated_at'];

    protected $table = 'order_audits';
    protected $fillable = ['order_id', 'field_name', 'old_value', 'new_value', 'user_id'];
    public $timestamps = false;

    protected $casts = [
        'created_at' => 'datetime',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($audit) {
            $audit->created_at = now(); 
        });
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
