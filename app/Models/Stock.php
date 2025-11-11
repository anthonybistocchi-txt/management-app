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
        'location_id',
        'updated_by',
        'created_by',
        'deleted_by',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(ProductLocation::class, 'location_id');
    }
}
