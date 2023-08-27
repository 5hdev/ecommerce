<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(\App\Models\Product::class, 'products_shops', 'shop_id', 'product_id');
    }
}
