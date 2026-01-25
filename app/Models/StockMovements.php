<?php

namespace App\Models;

use App\Traits\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockMovements extends Model
{
    use Userstamps;

    protected $table = 'stock_movements';

    protected $fillable = [
        'product_id',
        'quantity_moved',
        'location_id',
        'quantity_before',
        'quantity_after',
        'description',
        'movement_date',
        'type',
        'provider_id',
    ];

    protected $casts = [
        'quantity_moved'  => 'integer',
        'movement_date'   => 'datetime:d-m-Y H:i:s',
        'created_at'      => 'datetime:d-m-Y H:i:s',
        'updated_at'      => 'datetime:d-m-Y H:i:s',
        'deleted_at'      => 'datetime:d-m-Y H:i:s',
    ];
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
