<?php

namespace App\Services;

use App\Models\Courier;
use App\Models\CourierType;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CourierService
{
    public function create(Request $request): ?Collection
    {
        return collect($request->input('data'))->map(function ($item) {
            $item = collect($item);
            $courierTypeId = CourierType::where('name', $item->get('courier_type'))->value('id');
            $item->put('courier_type_id', $courierTypeId);

            $result = $courier = Courier::create($item->toArray());

            $result = $result ? $this->createWorkingHours(
                $item->get('working_hours'),
                $courier,
            ) : null;

            $result = $result ? $courier->courierRegions()->sync($item->get('regions')) : null;

            return $result ? $courier : null;
        });
    }

    public function update(Request $request, Courier $courier): ?Courier
    {
        $courierTypeId = CourierType::where('name', $request->input('courier_type'))->value('id');
        $request->merge(['courier_type_id' => $courierTypeId]);

        $result = $courier->update($request->only($courier->getFillable()));

        $courier->workingHours()->delete();

        $result = $result ? $this->createWorkingHours(
            $request->input('working_hours'),
            $courier,
        ) : null;

        $result = $result ? $courier->courierRegions()->sync($request->input('regions')) : null;

        return $result ? $courier : null;
    }

    private function createWorkingHours(array $workingHours, Courier $courier): Collection
    {
        $result = collect($workingHours)->map(function ($workingHour) use ($courier) {
            return [
                'courier_id' => $courier->id,
                'working_hours' => $workingHour,
            ];
        });

        return $courier->workingHours()->createMany($result);
    }

}
