<?php

namespace App\Services;

use App\Models\OrderCompletion;
use Illuminate\Http\Request;

class OrderCompletionService
{
    public function create(Request $request): OrderCompletion
    {
        return OrderCompletion::create($request->only((new OrderCompletion())->getFillable()));
    }

}
