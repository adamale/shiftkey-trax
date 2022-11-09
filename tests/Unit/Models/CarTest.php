<?php

namespace Tests\Unit\Models;

use App\Models\Car;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CarTest extends TestCase
{
    use WithFaker;

    public function testAddingCar()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $make = $this->faker->word();
        $model = $this->faker->word();
        $year = $this->faker->year();

        Car::query()->create(
            [
                'make' => $make,
                'model' => $model,
                'year' => $year,
            ]
        );

        $this->assertDatabaseHas('cars', [
            'user_id' => $user->getKey(),
            'make' => $make,
            'model' => $model,
            'year' => $year,
        ]);
    }
}
