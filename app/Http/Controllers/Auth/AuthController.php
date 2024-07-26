<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\UserAuthPostRequest;
use App\Http\Resources\MessageResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AuthController
 *
 * Контроллер отвечающий за операции аутентификации пользователей.
 */
class AuthController extends BaseController
{
    /**
     * Аутентифицирует пользователя и возвращает токен доступа при успешном входе.
     *
     * @param UserAuthPostRequest $request
     * @return JsonResponse
     */
    public function login(UserAuthPostRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return (new MessageResource('Неверные данные!'))->response()->setStatusCode(Response::HTTP_UNAUTHORIZED);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return (new UserResource($user))->additional(['token' => $token])->response()->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Выполняет выход пользователя из системы, удаляя текущий токен доступа.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return (new MessageResource('Вы вышли из системы!'))->response()->setStatusCode(Response::HTTP_OK);
    }

}
