<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderAssignmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'courier_id' => $this->courier_id,
            'order_id' => $this->order_id,
            'assign_time' => $this->assign_time,
        ];
    }

}
