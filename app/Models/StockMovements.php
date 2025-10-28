<?php

namespace App\Models;

use App\Traits\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockMovements extends Model
{
    use SoftDeletes;
    use Userstamps;
    
    protected $table = 'stock_movements';

    protected $fillable = [
        'product_id',
        'quantity',
        'movement_type',
        'location_id',
        'updated_by',
        'created_by',
        'deleted_by',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function location()
    {
        return $this->belongsTo(ProductLocation::class, 'location_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
