<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
     protected $fillable = [
        'product_id',
        'unit_of_measure_id',
        'quantity',
        'price',
        'created_at',
        'updated_at',
    ];
}
