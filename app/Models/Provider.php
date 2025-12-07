<?php

namespace App\Models;

use App\Traits\Userstamps;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    use SoftDeletes;
    //use Userstamps;

    protected $table = 'providers';

    protected $fillable = [
        'name',
        'cnpj',
        'phone',
        'email',
        'active',
        'deleted_at',
        'street',
        'number',
        'city',
        'state',
        'zipcode',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at'        => 'datetime:d-m-Y H:i:s',
        'updated_at'        => 'datetime:d-m-Y H:i:s',
        'deleted_at'        => 'datetime:d-m-Y H:i:s',

    ];

    protected function cnpj(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return preg_replace(
                    '/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/',
                    '$1.$2.$3/$4-$5',
                    $value
                );
            },
            set: function ($value) {
                return preg_replace('/[^0-9]/', '', $value);
            }
        );
    }
    
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'provider_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    } 

    public function deleter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
