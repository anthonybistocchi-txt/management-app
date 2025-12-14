<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryProductModel extends Model
{
    protected $table = 'category_products';

    protected $fillable = [
        'name',
        'description',
    ];
}
