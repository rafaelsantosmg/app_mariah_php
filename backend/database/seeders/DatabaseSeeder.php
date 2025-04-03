<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run()
  {
    // Usando a factory para criar os produtos
    Product::factory()->count(50)->create();  // Altere 50 para o número de registros que você quer criar
    User::factory()->count(1)->create(); // Altere 1 para o número de registros que você quer criar
  }
}
