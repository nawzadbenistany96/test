<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = ['id', 'user_id', 'product_id', 'image', 'pro_name', 'qty', 'price', 'sum_price', 'total_price'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
