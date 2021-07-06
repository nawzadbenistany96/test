<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Laptop extends Model
{
    use HasFactory;

    protected $table = "laptops";
    use Translatable;
    protected $translatable = ['name', 'color', 'describtion', 'new', 'touch_screen',];
}
