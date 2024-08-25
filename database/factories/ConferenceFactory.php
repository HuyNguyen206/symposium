<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conference>
 */
class ConferenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startsAt = now()->addMonths(6);
        $endsAt = $startsAt->clone()->addDays(3);

        $cfpStartAt = $startsAt->clone()->subMonths(4);
        $cfpEndAt = $cfpStartAt->clone()->addMonths(2);

        return [
            'title' => $this->faker->sentence(),
            'location' => sprintf('%s,%s', $this->faker->city(), $this->faker->country()),
            'description' => $this->faker->paragraph(),
            'url' => $this->faker->url(),
            'starts_at' => $startsAt,
            'ends_at' => $endsAt,
            'cfp_starts_at' => $cfpStartAt,
            'cfp_ends_at' => $cfpEndAt,
        ];
    }
}
