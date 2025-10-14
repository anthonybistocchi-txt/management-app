<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'cpf',
        'cnpj',
        'city',
        'state',
        'address',
        'is_customer',
        'created_at',
        'updated_at',
    ];
}
