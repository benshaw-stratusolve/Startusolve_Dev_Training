<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class IdeaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'     => User::factory(),
            'description' => fake()->sentence(12),
            'state'       => fake()->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
