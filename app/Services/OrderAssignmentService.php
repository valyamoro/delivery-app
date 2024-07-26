<?php

namespace App\Services;

use App\Models\OrderAssignment;
use Illuminate\Http\Request;

class OrderAssignmentService
{
    public function create(Request $request): OrderAssignment
    {
        return OrderAssignment::create($request->only((new OrderAssignment())->getFillable()));
    }

}
