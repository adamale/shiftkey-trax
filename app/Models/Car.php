<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $make
 * @property string $model
 * @property integer $year
 * @property \Illuminate\Support\Carbon $created_id
 * @property \Illuminate\Support\Carbon $updated_id
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|static query()
 * @method \Illuminate\Database\Eloquent\Builder|static owned()
 */
class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'make',
        'model',
        'year',
    ];

    protected static function booted(): void
    {
        static::creating(function (Car $car) {
            $car->user_id = auth()->id();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeOwned(Builder $query): Builder
    {
        return $query->where('user_id', auth()->id());
    }
}
