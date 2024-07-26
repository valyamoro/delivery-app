<?php

namespace App\Rules;

use Closure;
use Exception;
use Illuminate\Contracts\Validation\ValidationRule;

class TimeRange implements ValidationRule
{
    /**
     * @throws Exception
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^\d{2}:\d{2}-\d{2}:\d{2}$/', $value)) {
            $fail('У :attribute должен быть формат HH:mm-HH:mm.');
            return;
        }

        [$startTime, $endTime] = explode('-', $value);

        $start = new \DateTime($startTime);
        $end = new \DateTime($endTime);

        if ($start > $end) {
            $fail('У :attribute некорректное время.');
        }
    }

}
