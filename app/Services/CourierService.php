<?php

namespace App\Services;

use App\Models\Courier;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CourierService
{
    public function create(Request $request): Collection
    {
        return collect($request->input('data'))->map(function ($item) {
            return Courier::create($item);
        });
    }

    public function update(Request $request, Courier $courier): ?Courier
    {
        $result = $courier->update($request->only($courier->getFillable()));

        return $result ? $courier : null;
    }

}
