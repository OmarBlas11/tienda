<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product_Sale;
use App\Models\Table;

class Sale extends Model
{
    use HasFactory;

    public function product_sales()
    {
        return $this->hasMany(Product_Sale::class);
    }
    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
