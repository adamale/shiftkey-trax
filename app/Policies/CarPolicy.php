<?php

namespace App\Policies;

use App\Models\Car;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CarPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Car $car): bool
    {
        return $car->user()->is($user);
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Car $car)
    {
        //
    }

    public function delete(User $user, Car $car)
    {
        //
    }
}
