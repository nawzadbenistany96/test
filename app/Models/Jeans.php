<?php

namespace App\Models;

use App\Models\Category;
use TCG\Voyager\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jeans extends Model
{
    use HasFactory;

    protected $table = 'jeans';
    protected $fillable = [
        'id',
        'name',
        'color',
        'describtion',
        'image1',
        'image2',
        'image3',
        'image4',
        'date_available',
        's-28', 's-29', 's-30', 's-31', 's-32', 's-33', 's-34', 's-35', 's-36', 's-37', 's-38', 's-39', 's-40',
        'price',
        'qty',
        'discount',
        'ordered',
        'new',
        'status',
        'category_id',
    ];

    use Translatable;
    protected $translatable = ['name', 'color', 'describtion', 'new',];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
