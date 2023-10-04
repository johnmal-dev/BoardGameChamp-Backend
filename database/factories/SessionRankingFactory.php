<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SessionRankingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'session_rank' => $this->faker->numberBetween(1, 4),
        ];
    }
}
