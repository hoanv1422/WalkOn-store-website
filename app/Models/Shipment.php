<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'courier_id',
        'status',
        'tracking_number',
    ];

    /**
     * Get the order associated with the shipment.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the courier assigned to the shipment.
     */
    public function courier()
    {
        return $this->belongsTo(Courier::class);
    }
}
