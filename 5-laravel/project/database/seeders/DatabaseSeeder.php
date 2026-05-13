<?php

namespace Database\Seeders;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // A known test account you can always log in with
        $testUser = User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Give the test user some ideas
        Idea::factory(6)->create(['user_id' => $testUser->id]);

        // 4 extra random users, each with 3-6 ideas
        User::factory(4)->create()->each(function (User $user) {
            Idea::factory(rand(3, 6))->create(['user_id' => $user->id]);
        });
    }
}
