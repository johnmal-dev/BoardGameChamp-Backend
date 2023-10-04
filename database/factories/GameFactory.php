<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    public function definition(): array
    {
        return [
            'game_name' => $this->faker->name . ' Game',
            'game_description' => $this->faker->text,
            'game_image' => $this->faker->imageUrl(),
            'game_url' => $this->faker->url,
            'game_min_players' => 1,
            'game_max_players' => $this->faker->numberBetween(2, 4),
            'game_min_playtime' => 1,
            'game_max_playtime' => $this->faker->numberBetween(2, 10)
        ];
    }
}
