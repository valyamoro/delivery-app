<?php

namespace App\Rules;

use App\Models\OrderAssignment;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckOrderNoAssigned implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $orderAssignments = OrderAssignment::where('order_id', '=', $value)->get();

        if ($orderAssignments->toArray() === []) {
            $fail('Вы не можете завершить не начатый заказ!');
        }
    }
}
