<?php

namespace App\Http\Requests\Courier;

use App\Http\Requests\BaseFormRequest;
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
            'data.*.courier_type' => 'required|string|in:foot,bike,car',
            'data.*.regions' => 'required|array',
            'data.*.regions.*' => 'required|int',
            'data.*.working_hours' => 'required|array',
            'data.*.working_hours.*' => [
                'required',
                new TimeRange(),
            ],
        ];
    }

}
