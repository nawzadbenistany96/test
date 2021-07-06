<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';
    protected $fillable = [
        'id',
        'name',
        'slug',
        'price',
    ];

    use Translatable;
    protected $translatable = ['name', 'slug',];
}
