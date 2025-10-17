<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'order_status_id',
        'total_amount_in_cents',
        'notes',
        'ordered_at'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id');
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }
}

