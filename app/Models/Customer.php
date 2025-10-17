<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'user_id', 
        'name', 
        'phone', 
        'document_type', 
        'document_number',
        'address_street', 
        'address_number', 
        'address_complement',
        'address_city', 
        'address_state', 
        'address_zipcode'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
