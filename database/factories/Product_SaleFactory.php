<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Product_Sale;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product_Sale>
 */
class Product_SaleFactory extends Factory
{
    protected $model = Product_Sale::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $cantidad = $this->faker->numberBetween(1, 10);
        $product_id = Product::all()->random()->id;
        $obtenerprecioventa = Product::where('id', $product_id)->first();
        $preciodeventa=$obtenerprecioventa->precio_venta;
        $formatnumber = number_format($cantidad, 2);
        return [
            'sale_id' => Sale::all()->random()->id,
            'product_id' => $product_id,
            'cantidad' =>  $cantidad,
            'total' => $preciodeventa * $formatnumber ,
        ];
    }
}
