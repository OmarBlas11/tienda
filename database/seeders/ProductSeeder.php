<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::factory(100)->create();
        foreach ($products as $product) {
            $cantidad = random_int(2, 10);
            $product->sale()->attach([
                'cantidad'=> $cantidad,
                rand(1 , 50 ),
                rand(51, 100),
                rand(101, 150 ),
                rand(151, 200),
            ]);
        }
    }
}
