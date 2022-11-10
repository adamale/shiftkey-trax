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

    public function testListingOwnedCars()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        Car::factory()->count(3)->create();

        $anotherUser = User::factory()->create();
        $this->actingAs($anotherUser);
        Car::factory()->count(2)->create();

        $this->actingAs($user);
        $this->assertCount(3, Car::query()->owned()->get());
    }

    public function test_user_can_view_owned_car()
    {
        /** @var \App\User $user */
        $user = User::factory()->create();
        $this->actingAs($user);
        $car = Car::factory()->create();

        $this->assertTrue($user->can('view', $car));
    }

    public function test_user_cannot_view_someones_car()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $car = Car::factory()->create();

        /** @var \App\User $anotherUser */
        $anotherUser = User::factory()->create();
        $this->actingAs($anotherUser);

        $this->assertTrue($anotherUser->cannot('view', $car));
    }
}
