<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table = 'providers';

    protected $fillable = [
        'id',
        'name',
        'cnpj',
        'phone',
        'email',
        'is_active',
        'deleted_at',
        'address_street',
        'address_number',
        'address_city',
        'address_state',
        'address_zipcode',
        'created_at',
        'updated_at'
    ];
}
