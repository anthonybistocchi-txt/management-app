<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'stock_quantity',
        'provider_id',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'price'          => 'integer',
        'stock_quantity' => 'integer',
        'created_at'     => 'datetime:d-m-Y H:i:s',
        'updated_at'     => 'datetime:d-m-Y H:i:s',
        'deleted_at'     => 'datetime:d-m-Y H:i:s',
    ];

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value / 100,

            set: fn($value) => $value * 100
        );
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
