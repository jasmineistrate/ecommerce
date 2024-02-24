<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 11, 
            'product_name' => fake()->name(),
            'total_price' => rand(10,1000000),
            'quantity' => rand(10,1000000),
            'adress' => fake()->address(),
            'city' => fake()->city(),
            'country' => fake()->country(),
            'status' => 'paid'
        ];
    }
}
