<?php

namespace App\Rules;

use App\Models\OrderAssignment;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CompleteTimeMoreThanAssignTime implements ValidationRule
{
    public function __construct(
        private readonly int $courierId,
        private readonly int $orderId,
    ) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $orderAssigment = OrderAssignment::where('courier_id', '=', $this->courierId)
            ->where('order_id', '=', $this->orderId)->first();

        [$assignDay, $assignTime] = explode(' ', $orderAssigment->assign_time);
        [$completeDay, $completeTime] = explode(' ', $value);

        $assignTimeStamp = Carbon::createFromFormat('H:i:s', $assignTime);
        $completeTimeStamp = Carbon::createFromFormat('H:i', $completeTime);

        if ($completeTimeStamp->lessThanOrEqualTo($assignTimeStamp)) {
            $fail('Время доставки не может быть раньше или равным назначенного времени.');
        }
    }

}
