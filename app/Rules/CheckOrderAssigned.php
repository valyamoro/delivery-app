<?php

namespace App\Rules;

use App\Models\OrderAssignment;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckOrderAssigned implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $orderAssignments = OrderAssignment::where('order_id', '=', $value)->get();

        if ($orderAssignments->toArray() !== []) {
            $fail('Заказ #' . $value . ' уже назначен курьеру!');
        }
    }
}
