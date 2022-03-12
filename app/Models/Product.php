<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Product_Sale;

class Product extends Model
{
    use HasFactory;

    public function catetgory()
    {
        return $this->belongsTo(Category::class);
    }

    /* relacion con productos con sales */
    public function product_sale()
    {
        return $this->hasMany(Product_Sale::class);
    }
}
