<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTripRequest;
use App\Models\Trip;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TripController extends Controller
{
    public function index(): JsonResource
    {
        $results = DB::table('trips')
            ->join('cars', function (JoinClause $join) {
                $join->on('trips.car_id', 'cars.id');
                $join->on('cars.user_id', DB::raw(auth()->id()));
            })
            ->get(['trips.id', 'trips.date', 'trips.miles', 'cars.id as car_id', 'cars.make as car_make', 'cars.model as car_model', 'cars.year as car_year']);

        $totalMileage = $results->sum('miles');
        $calculatedMileage = 0;
        $totals = $results
            ->sortBy('date')
            ->reduce(function ($result, $value) use ($totalMileage, &$calculatedMileage) {
                $result[$value->id] = round($totalMileage - $value->miles - $calculatedMileage, 1);
                $calculatedMileage = round($calculatedMileage + $value->miles, 1);
                return $result;
            }, []);

        $trips = $results->map(function (\StdClass $result) use ($totals) {
            return [
                'id' => $result->id,
                'date' => Carbon::make($result->date)->format('d/m/Y'),
                'miles' => $result->miles,
                'total' => $totals[$result->id] ?? 0,
                'car' => [
                    'id' => $result->car_id,
                    'make' => $result->car_make,
                    'model' => $result->car_model,
                    'year' => $result->car_year,
                ],
            ];
        });

        return new JsonResource($trips);
    }

    public function store(StoreTripRequest $request): Response
    {
        Trip::query()->create($request->validated());

        return response()->noContent();
    }
}
