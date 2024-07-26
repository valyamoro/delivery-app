<?php

namespace App\Http\Requests\Courier;

use App\Http\Requests\BaseFormRequest;
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
            'courier_type' => 'required|string|in:foot,bike,car',
            'regions' => 'required|array',
            'regions.*' => 'required|int',
            'working_hours' => 'required|array',
            'working_hours.*' => [
                'required',
                new TimeRange(),
            ],
        ];
    }

}
