<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'city',
        'district',
        'ward',
        'address_line',
        'type',
        'latitude',
        'longitude',
        'is_default'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullAddressAttribute()
    {
        return "{$this->address_line}, {$this->ward}, {$this->district}, {$this->city}";
    }

    public function getTypeLabelAttribute()
    {
        $types = [
            'OFFICE' => 'Cơ quan',
            'HOME' => 'Nhà riêng',
            'OTHER' => 'Khác',
        ];

        return $types[$this->type] ?? 'Không xác định';
    }
}
