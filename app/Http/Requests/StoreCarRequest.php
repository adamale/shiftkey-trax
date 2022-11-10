<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'make' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|integer',
        ];
    }

    public function attributes(): array
    {
        return [
            'make' => __('car.fields.make'),
            'model' => __('car.fields.model'),
            'year' => __('car.fields.year'),
        ];
    }
}
