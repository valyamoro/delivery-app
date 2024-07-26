<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\BaseFormRequest;
use App\Rules\TimeRange;

class OrdersPostRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'data' => 'required|array',
            'data.*.weight' => 'required|numeric',
            'data.*.region' => 'required|integer',
            'data.*.delivery_hours' => ['required', new TimeRange()],
        ];
    }

}
