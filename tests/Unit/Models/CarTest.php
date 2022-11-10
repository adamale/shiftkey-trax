<?php

namespace Tests\Unit\Models;

use App\Models\Car;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CarTest extends TestCase
{
    use WithFaker;

    public function test_car_can_be_added_by_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $car = Car::query()->create(
            [
                'make' => $this->faker->word(),
                'model' => $this->faker->word(),
                'year' => $this->faker->year(),
            ]
        );

        $this->assertModelExists($car);
    }

    public function test_car_list_can_be_limited_to_contain_only_cars_owned_by_user()
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

    public function test_car_can_be_viewed_by_owner()
    {
        /** @var \App\User $user */
        $user = User::factory()->create();
        $this->actingAs($user);
        $car = Car::factory()->create();

        $this->assertTrue($user->can('view', $car));
    }

    public function test_car_cannot_be_viewed_by_non_owner()
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
