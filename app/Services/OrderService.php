<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class OrderService
{
    public function create(Request $request): Collection
    {
        return collect($request->input('data'))->map(function ($item) {
            $item = collect($item);

            $item->put('region_id', $item->get('region'));

            return Order::create($item->toArray());
        });
    }

}
