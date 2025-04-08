<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'name'          => $this->faker->word,
      'stock'         => $this->faker->randomNumber(),
      'cost_price'    => $this->faker->randomFloat(2, 1, 100),
      'sale_price'    => $this->faker->randomFloat(2, 1, 100),
      'profit_margin' => $this->faker->randomFloat(2, 0, 10),
      'description'   => $this->faker->text(200),
      'code'          => $this->faker->unique()->numerify('####'),
      'created_at'    => Carbon::now(),
      'updated_at'    => Carbon::now(),
      'stock_type'    => $this->faker->randomElement(['KG', 'UN']),
    ];
  }
}
