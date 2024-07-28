<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrdersCompletePostRequest;
use App\Http\Resources\OrderCompletionResource;
use App\Services\OrderCompletionService;

/**
 * Class OrderCompletionController
 *
 * Контроллер отвечающий за операции, связанные с завершением заказов.
 */
class OrderCompletionController extends Controller
{
    /**
     * Конструктор OrderCompletionController.
     *
     * @param OrderCompletionService $orderCompletionService
     */
    public function __construct(
        private readonly OrderCompletionService $orderCompletionService,
    ) {}

    /**
     * Создает запись о завершении заказа.
     *
     * @param OrdersCompletePostRequest $request
     * @return OrderCompletionResource
     */
    public function store(OrdersCompletePostRequest $request): OrderCompletionResource
    {
        $result = $this->orderCompletionService->create($request);

        return new OrderCompletionResource($result);
    }

}
