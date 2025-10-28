<?php

namespace App\Models;

use App\Traits\Userstamps;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductLocation extends Model
{
    use SoftDeletes;
    use Userstamps;

    protected $table = 'products_locations';

    protected $fillable = [
        'name',
        'address',
        'city',
        'state',
        'cep',
        'product_id',
        'updated_by',
        'created_by',
        'deleted_by',
    ];


    protected $casts = [
        'created_at'        => 'datetime:d-m-Y H:i:s',
        'updated_at'        => 'datetime:d-m-Y H:i:s',
        'deleted_at'        => 'datetime:d-m-Y H:i:s',

    ];

    protected function cep(): Attribute
    {
        return Attribute::make(
            set: fn($value) => preg_replace('/[^0-9]/', '', $value),

            get: fn($value) => preg_replace('/(\d{5})(\d{3})/', '$1-$2', $value)
        );
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
