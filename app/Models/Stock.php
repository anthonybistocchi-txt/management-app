<?php

namespace App\Models;

use App\Traits\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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