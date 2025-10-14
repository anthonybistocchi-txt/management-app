<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitOfMeasure extends Model
{
     protected $fillable = [
        'name',
        'abbreviation',
        'created_at',
        'updated_at',
    ];
}
