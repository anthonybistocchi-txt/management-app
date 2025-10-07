<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
   protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'is_active',
        'desactivated_at',
        'created_at',
        'updated_at',
   ];
}
