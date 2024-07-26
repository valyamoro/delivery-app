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
            return Order::create($item);
        });
    }

}
