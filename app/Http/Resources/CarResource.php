<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var \App\Models\Car $this **/
        return [
            'id' => $this->getKey(),
            'make' => $this->make,
            'model' => $this->model,
            'year' => $this->year,
            'trip_count' => $this->trips()->count(),
            'trip_miles' => $this->trips()->sum('miles'),
        ];
    }
}
