<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name=$this->faker->unique()->word(20);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'precio_compra' => $this->faker->randomFloat(2, 10, 20),
            'precio_venta' => $this->faker->randomFloat(2, 20, 30),
            'stock' => $this->faker->numberBetween(5, 50),
            'category_id' => Category::all()->random()->id,
        ];
    }
}
