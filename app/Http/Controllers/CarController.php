<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use Illuminate\Http\Response;

class CarController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Car::class);
    }

    public function index()
    {
        //
    }

    public function store(StoreCarRequest $request): Response
    {
        Car::query()->create($request->validated());

        return response()->noContent();
    }

    public function show(Car $car)
    {
        //
    }

    public function update(UpdateCarRequest $request, Car $car)
    {
        //
    }

    public function destroy(Car $car)
    {
        //
    }
}
