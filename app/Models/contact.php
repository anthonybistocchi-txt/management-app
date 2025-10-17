<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'user_id', 
        'contact_reason_id', 
        'name', 
        'email', 
        'phone', 
        'message'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reason()
    {
        return $this->belongsTo(ContactReason::class, 'contact_reason_id');
    }
}
