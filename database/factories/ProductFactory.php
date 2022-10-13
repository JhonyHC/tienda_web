<?php

namespace Database\Factories;

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
    public function definition()
    {
        return [
            'name' => fake()->words(2,true),
            'price' => fake()->randomFloat(2,20,2000),
            'category' => fake()->randomElement(['toys','materials','clothes']),
            'description' => fake()->sentence(8),
            'stock' => fake()->numberBetween(0,100)
        ];
    }
}
