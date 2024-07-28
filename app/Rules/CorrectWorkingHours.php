<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CorrectWorkingHours implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        collect($value)->each(function ($timeRange, $index) use ($value, $fail, $attribute) {
            if ($index < count($value) - 1) {
                [$currentStart, $currentEnd] = explode('-', $timeRange);
                [$nextStart, $nextEnd] = explode('-', $value[$index + 1]);

                $currentEndTimestamp = Carbon::createFromFormat('H:i', $currentEnd);
                $nextStartTimestamp = Carbon::createFromFormat('H:i', $nextStart);

                if ($currentEndTimestamp->greaterThanOrEqualTo($nextStartTimestamp)) {
                    $fail("У :attribute некорректное значение.");
                }
            }
        });
    }

}
