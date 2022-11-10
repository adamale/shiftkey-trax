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
}
