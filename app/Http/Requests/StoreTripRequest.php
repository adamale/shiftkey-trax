<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTripRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'car_id' => [
                'required',
                Rule::exists('cars', 'id')
                    ->where('user_id', auth()->id()),
            ],
            'date' => 'required|date', // ISO 8601 string
            'miles' => 'required|numeric|max:999999.9',
        ];
    }

    public function attributes(): array
    {
        return [
            'car_id' => __('trip.fields.car_id'),
            'date' => __('trip.fields.date'),
            'miles' => __('trip.fields.miles'),
        ];
    }
}
