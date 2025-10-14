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
        'is_provider',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}
