<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $car_id
 * @property \Illuminate\Support\Carbon $date
 * @property float $miles
 * @property \Illuminate\Support\Carbon $created_id
 * @property \Illuminate\Support\Carbon $updated_id
 * @property-read \App\Models\Car $car
 */
class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'date',
        'miles',
    ];

    protected $dates = [
        'date',
    ];

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
