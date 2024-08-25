<?php

namespace Database\Seeders;

use App\Models\Conference;
use App\Models\Talk;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\ConferenceFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory()->has(Talk::factory()->count(5))
         ->create(['name' => 'huy', 'email' => 'nguyenlehuyuit@gmail.com']);

         User::factory(10)->has(Talk::factory()->count(5))
         ->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Conference::factory(5)->create();
    }
}
