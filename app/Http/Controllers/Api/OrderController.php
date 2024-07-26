<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Order\OrdersPostRequest;
use App\Http\Resources\OrdersResource;
use App\Services\OrderService;

/**
 * Class OrderController
 *
 * Контроллер отвечает за операции, связанными с заказами, такими как создание нового заказа.
 */
class OrderController extends BaseController
{
    /**
     * Конструктор OrderController.
     *
     * @param OrderService $orderService
     */
    public function __construct(
        private readonly OrderService $orderService,
    ) {}

    /**
     * Создает новый заказ.
     *
     * @param OrdersPostRequest $request
     * @return OrdersResource
     */
    public function store(OrdersPostRequest $request): OrdersResource
    {
        $result = $this->orderService->create($request);

        return new OrdersResource($result);
    }

}
