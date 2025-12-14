<?php

namespace App\Models;

use App\Traits\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockMovements extends Model
{
    use SoftDeletes;
    use Userstamps;

    protected $table = 'stock_movements';

    protected $fillable = [
        'product_id',
        'quantity_moved',
        'location_id',
        'previous_quantity',
        'new_quantity',
        'description',
        'type',
        'provider_id',
        'created_by',
    ];

    protected $casts = [
        'created_at'     => 'datetime:d-m-Y H:i:s',
        'updated_at'     => 'datetime:d-m-Y H:i:s',
        'deleted_at'     => 'datetime:d-m-Y H:i:s',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
