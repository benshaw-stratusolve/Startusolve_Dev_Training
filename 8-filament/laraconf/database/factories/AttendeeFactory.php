<?php

namespace Database\Factories;

use App\Models\Attendee;
use App\Models\Conference;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Attendee>
 */
class AttendeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'ticket_cost' => 50000,
            'is_paid' => fake()->boolean(),
            'conference_id' => Conference::factory(),
            'created_at' => fake()->dateTimeBetween('-3 months'),
        ];
    }
}
