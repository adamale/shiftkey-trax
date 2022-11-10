<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTripRequest;
use App\Http\Resources\TripCollection;
use App\Models\Trip;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class TripController extends Controller
{
    public function index(): ResourceCollection
    {
        return new TripCollection(Trip::query()->owned()->get());
    }

    public function store(StoreTripRequest $request): Response
    {
        Trip::query()->create($request->validated());

        return response()->noContent();
    }
}
