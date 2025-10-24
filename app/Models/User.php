<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'id',
        'name',
        'email',
        'cpf',
        'password',
        'created_at',
        'updated_at',
        'is_active',
        'id_type_user',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'password'          => 'hashed',
        'email_verified_at' => 'datetime',
        'created_at'        => 'datetime:d-m-Y H:i:s',
        'updated_at'        => 'datetime:d-m-Y H:i:s',
        'deleted_at'        => 'datetime:d-m-Y H:i:s',

    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id_type_user');
    }
}
