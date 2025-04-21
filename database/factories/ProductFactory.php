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
    public function definition(): array
    {
        return [
            'image' => 'https://placehold.co/600x400/png/'.fake()->regexify('[A-F0-9]{6}').'?text='.urlencode(fake()->words(2, true)),           
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(3), 
            'price' => fake()->randomDigit()
        ];
    }
}
