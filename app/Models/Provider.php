<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = [
        'name',
        'cnpj',
        'phone',
        'email',
        'address_street',
        'address_city',
        'address_state',
        'address_zipcode'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

