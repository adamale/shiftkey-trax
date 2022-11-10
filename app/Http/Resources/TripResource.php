<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var \App\Models\Trip $this **/
        return [
            'id' => $this->getKey(),
            'date' => $this->date->format('m/d/Y'),
            'miles' => $this->miles,
            'total' => $this->total,
            'car' => new CarResourceCompact($this->car),
        ];
    }
}
