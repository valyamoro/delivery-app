<?php

namespace App\Rules;

use App\Models\Courier;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckCourierAvailability implements ValidationRule
{
    public function __construct(
        private readonly int $courierId,
    ) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $available = false;

        $courier = Courier::findOrFail($this->courierId);
        $workingHours = $courier->workingHours;

        foreach ($workingHours as $workingHour) {
            $datetime = Carbon::createFromFormat('Y-m-d H:i', $value);

            [$startTime, $endTime] = explode('-', $workingHour->working_hours);

            $startTime = Carbon::createFromTimeString($startTime);
            $endTime = Carbon::createFromTimeString($endTime);

            $time = $datetime->format('H:i');

            if (($time >= $startTime->format('H:i') && $time <= $endTime->format('H:i')) === false) {
                return;
            } else {
                $available = true;
            }
        }

        if ($available) {
            $fail('Курьер не работает в это время. Пожалуйста, выберите другого.');
        }
    }

}
