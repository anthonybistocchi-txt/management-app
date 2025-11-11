<?php

namespace App\Models;

use App\Traits\Userstamps;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;
    //use Userstamps;
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'cpf',
        'password',
        'created_at',
        'updated_at',
        'deleted_at',
        'deleted_by',
        'updated_by',
        'created_by',
        'is_active',
        'type_user_id',
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

    protected function cpf(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return preg_replace(
                    '/^(\d{3})(\d{3})(\d{3})(\d{2})$/',
                    '$1.$2.$3-$4',
                    $value
                );
            },
            set: function ($value) {
                return preg_replace('/[^0-9]/', '', $value);
            }
        );
    }

    public function users()
    {
        return $this->hasMany(User::class, 'type_user_id');
    }

    public function typeUser()
    {
        return $this->belongsTo(TypeUser::class, 'type_user_id');
    }
}
