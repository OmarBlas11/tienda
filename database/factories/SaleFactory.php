<?php

namespace Database\Factories;

use App\Models\Product_Sale;
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
        $moths = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        $number = rand(0, 11);
        $numberday = rand(0, 29);
        $days = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30'];
        $mothsthisyear = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        $semana = date('W', mktime(0, 0, 0, $mothsthisyear[$number], $days[$numberday], '2022'));
        return [
            'fecha_venta' => $days[$numberday] . '-' . $mothsthisyear[$number] . '-2022',
            'hora' => $this->faker->time(),
            'month' => $moths[$number],
            'day' => $days[$numberday],
            'year' => '2022',
            'semana' => $semana,
            'table_id' => Table::all()->random()->id,
        ];
    }
}
