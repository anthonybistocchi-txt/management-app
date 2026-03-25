<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{   
    protected $table = 'stock';

    public $timestamps = false;
    protected $fillable = [
        'product_id',
        'location_id',
        'quantity',
    ];
}