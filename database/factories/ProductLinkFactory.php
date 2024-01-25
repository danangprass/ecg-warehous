<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductLink>
 */
class ProductLinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'owner_id' => User::whereRelation('roles', 'name', 'employee')->inRandomOrder()->first()->id,
            'link' => fake()->imageUrl(),
            'amount' => rand(1, 35),
        ];
    }
}
