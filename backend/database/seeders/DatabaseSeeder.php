<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Usando a factory para criar os produtos
        Product::factory()->count(20)->create();  // Altere 20 para o número de registros que você quer criar
    }
}
