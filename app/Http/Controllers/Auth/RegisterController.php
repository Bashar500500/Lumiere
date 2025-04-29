<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Trait\FunctionName;
use App\Enums\Trait\ModelName;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Response\ResponseController;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\AuthResource;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    public function __construct(
        ResponseController $controller,
        protected UserService $service,
    ) {
        parent::__construct($controller);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $data = AuthResource::make(
            $this->service->register($request)
        );

        return $this->controller
            ->setFunctionName(FunctionName::Store)
            ->setModelName(ModelName::User)
            ->setData($data)
            ->successResponse();
    }
}
