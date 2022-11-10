<?php

namespace Tests\Unit\Models;

use App\Models\Trip;
use App\User;
use Tests\TestCase;

class TripTest extends TestCase
{
    public function test_trip_can_be_added_by_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $trip = Trip::factory()->create();

        $this->assertModelExists($trip);
    }

    public function test_trip_list_can_be_limited_to_contain_only_trips_owned_by_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        Trip::factory()->count(3)->create();

        $anotherUser = User::factory()->create();
        $this->actingAs($anotherUser);
        Trip::factory()->count(2)->create();

        $this->actingAs($user);
        $this->assertCount(3, Trip::query()->owned()->get());
    }
}
