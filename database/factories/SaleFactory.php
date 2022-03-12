<?php

namespace Database\Factories;

use App\Models\Sale;
use App\Models\Table;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    protected $model = Sale::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fecha_venta' => $this->faker->date(),
            'hora' => $this->faker->time(),
            'table_id' => Table::all()->random()->id,
        ];
    }
}
