<?php

namespace App\Models;

use App\Models\Jeans;
use App\Models\Phone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends \TCG\Voyager\Models\Category
{
    use HasFactory;

    public function jeans()
    {
        return $this->hasMany(Jeans::class);
    }
    public function phones()
    {
        return $this->hasMany(Phone::class);
    }
}
