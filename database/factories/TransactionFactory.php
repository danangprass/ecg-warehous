<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductLink;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => now()->format('Y-m-d'),
            'type' => Arr::random(['repair', 'modif']),
            'owner_id' => User::whereRelation('roles', 'name', 'employee')->inRandomOrder()->first()->id,
            'link' => fake()->imageUrl()
        ];
    }
}
