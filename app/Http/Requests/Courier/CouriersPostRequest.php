<?php

namespace App\Http\Requests\Courier;

use App\Http\Requests\BaseFormRequest;
use App\Rules\CorrectWorkingHours;
use App\Rules\TimeRange;

class CouriersPostRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'data' => 'required|array',
            'data.*.courier_type' => 'required|string|exists:courier_types,name',
            'data.*.regions' => 'required|array',
            'data.*.regions.*' => 'required|int|exists:regions,id',
            'data.*.working_hours' => [
                'required',
                'array',
                new CorrectWorkingHours(),
            ],
            'data.*.working_hours.*' => [
                'required',
                new TimeRange(),
            ],
        ];
    }

}
