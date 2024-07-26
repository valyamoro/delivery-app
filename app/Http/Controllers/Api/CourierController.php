<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Courier\CouriersPostRequest;
use App\Http\Requests\Courier\CourierUpdateRequest;
use App\Http\Resources\CourierResource;
use App\Http\Resources\CouriersResource;
use App\Models\Courier;
use App\Services\CourierService;

/**
 * Class CourierController
 *
 * Контроллер отвечающий за работу с курьерами.
 *
 * @package App\Http\Controllers
 */
class CourierController extends BaseController
{
    /**
     * CourierController конструктор.
     *
     * @param CourierService $courierService
     */
    public function __construct(
        private readonly CourierService $courierService,
    ) {}

    /**
     * Создает новых курьеров.
     *
     * @param CouriersPostRequest $request
     * @return CouriersResource
     */
    public function store(CouriersPostRequest $request): CouriersResource
    {
        $result = $this->courierService->create($request);

        return new CouriersResource($result);
    }

    /**
     * Отображение нужного курьера.
     *
     * @param Courier $courier
     * @return CourierResource
     */
    public function show(Courier $courier): CourierResource
    {
        return new CourierResource($courier);
    }

    /**
     * Обновление нужного курьера.
     *
     * @param CourierUpdateRequest $request
     * @param Courier $courier
     * @return CourierResource
     */
    public function update(CourierUpdateRequest $request, Courier $courier): CourierResource
    {
        $result = $this->courierService->update($request, $courier);

        return new CourierResource($result);
    }

}
