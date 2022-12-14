<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CarCollection extends ResourceCollection
{
    public $collects = CarResourceCompact::class;

    public function toArray($request): array
    {
        return [
            'data' => $this->collection,
        ];
    }
}
