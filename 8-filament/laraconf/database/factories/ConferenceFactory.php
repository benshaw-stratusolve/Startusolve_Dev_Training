<?php

namespace Database\Factories;

use App\Enums\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConferenceFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $startDate = now()->addMonths(9);

        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'start_date' => $startDate,
            'end_date' => $startDate->copy()->addDays(2),
            'status' => fake()->randomElement([
                'draft',
                'published',
                'archived',
            ]),
            'region' => fake()->randomElement(Region::cases()),
            'is_published' => fake()->boolean(),
            'venue_id' => null,
        ];
    }
}
