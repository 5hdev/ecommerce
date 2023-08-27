<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'detail', 'stock','price','discount'
    ];

    public function categories()
    {
        return $this->belongsToMany(\App\Models\Category::class, 'products_categories', 'product_id','category_id');
    }

    public function shops()
    {
        return $this->belongsToMany(\App\Models\Shop::class, 'products_shops', 'product_id','shop_id');
    }
}
