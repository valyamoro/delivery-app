<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\BaseFormRequest;
use App\Rules\CheckCourierAvailability;
use App\Rules\CheckOrderAssigned;
use App\Rules\CheckOrderCompleted;

class OrdersAssignPostRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'courier_id' => 'required|integer|exists:couriers,id',
            'order_id' => [
                'required',
                'integer',
                'exists:orders,id',
                new CheckOrderAssigned(),
                new CheckOrderCompleted(),
            ],
            'assign_time' => [
                'required',
                'date_format:Y-m-d H:i',
                new CheckCourierAvailability($this->input('courier_id')),
                'after:now',
            ],
        ];
    }

}
