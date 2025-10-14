<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
     protected $fillable = [
        'product_id',
        'color',
        'size',
        'material',
        'additional_info',
        'unit_of_measure_id',
        'created_at',
        'updated_at',
    ];
}
