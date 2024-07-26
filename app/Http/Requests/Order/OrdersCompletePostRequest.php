<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\BaseFormRequest;
use App\Rules\CheckOrderCompleted;
use App\Rules\CheckOrderNoAssigned;

class OrdersCompletePostRequest extends BaseFormRequest
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
                new CheckOrderCompleted(),
                new CheckOrderNoAssigned(),
            ],
            'complete_time' => 'required|date_format:Y-m-d H:i'
        ];
    }

}
