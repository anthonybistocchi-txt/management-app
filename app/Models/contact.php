<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// NOME DA CLASSE CORRIGIDO para "Contact"
class Contact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // ATRIBUTOS PREENCHÍVEIS (MASS ASSIGNMENT)
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'is_user',
    ];
}
