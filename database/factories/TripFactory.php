<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripFactory extends Factory
{
    public function definition(): array
    {
        return [
            'car_id' => Car::factory()->create()->getKey(),
            'date' => $this->faker->date(),
            'miles' => $this->faker->randomFloat(1,0, 999999.9),
        ];
    }
}
