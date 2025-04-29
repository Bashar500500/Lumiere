<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Trait\FunctionName;
use App\Enums\Trait\ModelName;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Response\ResponseController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\AuthResource;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    public function __construct(
        ResponseController $controller,
        protected AuthService $service,
    ) {
        parent::__construct($controller);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $data = AuthResource::make(
            $this->service->login($request)
        );

        return $this->controller
            ->setFunctionName(FunctionName::Login)
            ->setModelName(ModelName::User)
            ->setData($data)
            ->successResponse();
    }

    public function logout(): JsonResponse
    {
        $this->service->logout();

        return $this->controller
            ->setFunctionName(FunctionName::Logout)
            ->setModelName(ModelName::User)
            ->setData((object) [])
            ->successResponse();
    }
}
