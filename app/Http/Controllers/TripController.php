<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTripRequest;
use App\Models\Trip;
use Illuminate\Http\Response;

class TripController extends Controller
{
    public function index()
    {
        //
    }

    public function store(StoreTripRequest $request): Response
    {
        Trip::query()->create($request->validated());

        return response()->noContent();
    }
}
