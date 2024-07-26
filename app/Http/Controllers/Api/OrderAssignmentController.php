<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrdersAssignPostRequest;
use App\Http\Resources\OrderAssignmentResource;
use App\Services\OrderAssignmentService;

/**
 * Class OrderAssignmentController
 *
 * Контроллер отвечающий за назначение заказов курьерам.
 */
class OrderAssignmentController extends Controller
{
    /**
     * Конструктор OrderAssignmentController.
     *
     * @param OrderAssignmentService $orderAssignmentService
     */
    public function __construct(
        private readonly OrderAssignmentService $orderAssignmentService,
    ) {}

    /**
     * Создает новое назначение заказа.
     *
     * @param OrdersAssignPostRequest $request
     * @return OrderAssignmentResource
     */
    public function store(OrdersAssignPostRequest $request): OrderAssignmentResource
    {
        $result = $this->orderAssignmentService->create($request);

        return new OrderAssignmentResource($result);
    }

}
