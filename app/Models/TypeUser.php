<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TypeUser extends Model
{
    use  HasFactory, Notifiable;
    
    protected $table = 'type_users';

    protected $fillable = [
        'name',
        'created_at',
        'updated_at'
    ];

}
