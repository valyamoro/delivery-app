<?php

namespace App\Http\Requests\Courier;

use App\Http\Requests\BaseFormRequest;
use App\Rules\CorrectWorkingHours;
use App\Rules\TimeRange;

class CourierUpdateRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'courier_type' => 'required|string|exists:courier_types,name',
            'regions' => 'required|array',
            'regions.*' => 'required|int|exists:regions,id',
            'working_hours' => [
                'required',
                'array',
                new CorrectWorkingHours(),
            ],
            'working_hours.*' => [
                'required',
                new TimeRange(),
            ],
        ];
    }

}
