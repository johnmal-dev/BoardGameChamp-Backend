<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameSessionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'game_date' => Carbon::now(),
        ];
    }
}
