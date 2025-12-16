<?php

namespace App\Models;

use App\Traits\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use SoftDeletes;
    use Userstamps;
    
    protected $table = 'stock';

    protected $fillable = [
        'product_id',
        'quantity',
        'updated_by',
        'created_by',
        'deleted_by',
    ];

    protected $casts = [
        'created_at'     => 'datetime:d-m-Y H:i:s',
        'updated_at'     => 'datetime:d-m-Y H:i:s',
        'deleted_at'     => 'datetime:d-m-Y H:i:s',
    ];
}