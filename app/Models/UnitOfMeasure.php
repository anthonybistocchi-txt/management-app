<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitOfMeasure extends Model
{
    protected $fillable = [
        'name',
        'abbreviation'
    ];

    public function productDetails()
    {
        return $this->hasMany(ProductDetail::class);
    }
}

