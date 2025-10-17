<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'provider_id',
        'name',
        'slug',
        'description',
        'price_in_cents',
        'stock_quantity',
        'is_active'
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function details()
    {
        return $this->hasOne(ProductDetail::class);
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
}

