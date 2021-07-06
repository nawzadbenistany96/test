<?php

namespace App\Models;

use App\Models\Category;
use TCG\Voyager\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Phone extends Model
{
    use HasFactory;

    protected $table = 'phones';
    protected $fillable = [
        'id',
        'name',
        'brand',
        'model',
        'storage_capacity',
        'os',
        'simcard',
        'color',
        'image1',
        'image2',
        'image3',
        'image4',
        'describtion',
        'connectivity',
        'status',
        'date_available',
        'price',
        'qty',
        'discount',
        'new',
        'ordered',
        'category_id',
    ];

    use Translatable;
    protected $translatable = [
        'name',
        'brand',
        'model',
        'storage_capacity',
        'os',
        'simcard',
        'color',
        'describtion',
        'connectivity',
        'new',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
