<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Providers extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'cpnj',
        'city',
        'state',
        'address',
        'email',
        'is_provider',
        'created_at',
        'updated_at',
    ];
}
