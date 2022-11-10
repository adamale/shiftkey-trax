<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
 * @property-read int $total
 * @property-read \App\Models\Car $car
 * @method static \Illuminate\Database\Eloquent\Builder|static query()
 * @method \Illuminate\Database\Eloquent\Builder|static owned()
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

    public function scopeOwned(Builder $query): Builder
    {
        return $query->whereHas('car', function (Builder $query) {
            return $query->where('user_id', auth()->id());
        });
    }

    public function total(): Attribute
    {
        return Attribute::make(
            get: fn () => Trip::query()
                ->whereDate('date', '>', $this->date)
                ->orWhere(function (Builder $query) {
                    $query->whereDate('date', $this->date)
                        ->where('id', '>', $this->getKey());
                })
                ->sum('miles'),
        );
    }
}
