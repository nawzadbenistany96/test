<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Pc extends Model
{
    use HasFactory;

    protected $table = 'pcs';

    protected $fillable = [
        'id',
        'name',
        'new',
        'type',
        'brand',
        'ram',
        'os',
        'describtion',
        'harddisk_capacity',
        'color',
        'processor',
        'touch_screen',
        'date_available',
        'price',
        'qty',
        'discount',
        'ordered',
        'status',
        'category_id',
    ];

    use Translatable;
    protected $translatable = [
        'name',
        'new',
        'type',
        'brand',
        'ram',
        'os',
        'describtion',
        'harddisk_capacity',
        'color',
        'processor',
        'touch_screen',
    ];
}
