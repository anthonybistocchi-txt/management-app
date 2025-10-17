<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactReason extends Model
{
    protected $fillable = ['reason_text'];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}