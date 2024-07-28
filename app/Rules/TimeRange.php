<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TimeRange implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^\d{2}:\d{2}-\d{2}:\d{2}$/', $value)) {
            $fail('У :attribute должен быть формат HH:mm-HH:mm.');
            return;
        }

        [$startTime, $endTime] = explode('-', $value);

        $start = Carbon::createFromFormat('H:i', $startTime);
        $end = Carbon::createFromFormat('H:i', $endTime);

        if ($start->greaterThanOrEqualTo($end)) {
            $fail('У :attribute некорректное время.');
            return;
        }

        $maxTime = Carbon::createFromFormat('H:i', '23:59');
        if (!$end->lessThanOrEqualTo($maxTime)) {
            $fail('У :attribute некорректное время.');
            return;
        }
    }

}
