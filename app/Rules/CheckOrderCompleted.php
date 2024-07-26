<?php

namespace App\Rules;

use App\Models\OrderCompletion;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckOrderCompleted implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $orderCompletion = OrderCompletion::where('order_id', '=', $value)->get();

        if ($orderCompletion->toArray() !== []) {
            $fail('Заказ #' . $value . ' уже доставлен!');
        }
    }
}
