<?php

namespace App\Rules;

use App\Models\OrderAssignment;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckCourierAssignment implements ValidationRule
{
    public function __construct(
        private readonly int $courierId,
    ) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $orderAssignment = OrderAssignment::where('order_id', '=', $value)->first();

        if ($orderAssignment->courier_id !== $this->courierId) {
            $fail('За этот заказ взялся другой курьер!');
        }
    }
}
