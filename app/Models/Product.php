<?php

namespace App\Models;

use App\Traits\Userstamps;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    //use Userstamps;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'provider_id',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'price'          => 'numeric',
        'stock_quantity' => 'integer',
        'created_at'     => 'datetime:d-m-Y H:i:s',
        'updated_at'     => 'datetime:d-m-Y H:i:s',
        'deleted_at'     => 'datetime:d-m-Y H:i:s',
    ];

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function location() {
        return $this->hasOne(ProductLocation::class);
    }

    public function stock() {
        return $this->hasOne(Stock::class);
    }


    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deleter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
