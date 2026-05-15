<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(100)->create();

        User::factory()->create([
            'name' => 'Ben',
            'email' => 'benshawrob@gmail.com',
            'password' => bcrypt('password'),
        ]);

        \App\Models\Conference::factory(100)->create();
        \App\Models\Talk::factory(100)->create();
        \App\Models\Speaker::factory(100)->create();
        \App\Models\Venue::factory(100)->create();
        \App\Models\Attendee::factory(100)->create();

    }
}
