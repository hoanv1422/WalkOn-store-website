<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'email',
        'address',
        'vehicle_type',
        'license_plate',
        'delivery_area',
        'status',
        'rating',
        'total_orders',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
