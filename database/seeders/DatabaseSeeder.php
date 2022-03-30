<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Product_Sale;
use App\Models\Sale;
use App\Models\Table;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);

        /* Category::factory(4)->create();
        Product::factory(100)->create();
        Table::factory(8)->create();
        Sale::factory(200)->create();
        Product_Sale::factory(300)->create(); */
        
    }
}
