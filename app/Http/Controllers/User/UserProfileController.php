<?php

namespace App\Http\Controllers\User;

use App\Enums\Trait\FunctionName;
use App\Enums\Trait\ModelName;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Response\ResponseController;
use App\Http\Requests\UserProfile\UserProfileRequest;
use App\Http\Resources\UserProfile\UserProfileResource;
use App\Services\User\UserProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function __construct(
        ResponseController $controller,
        protected UserProfileService $service,
    ) {
        parent::__construct($controller);
    }

    public function show(): JsonResponse
    {
        $profile = $this->service->show(Auth::id());

        return $this->controller
            ->setFunctionName(FunctionName::Show)
            ->setModelName(ModelName::UserProfile)
            ->setData(new UserProfileResource($profile))
            ->successResponse();
    }

    public function store(UserProfileRequest $request): JsonResponse
    {
        $profile = $this->service->store($request, Auth::id());
        return $this->controller
            ->setFunctionName(FunctionName::Store)
            ->setModelName(ModelName::UserProfile)
            ->setData(new UserProfileResource($profile))
            ->successResponse();
    }

    public function update(UserProfileRequest $request): JsonResponse
    {
        $profile = $this->service->update($request, Auth::id());
        return $this->controller
            ->setFunctionName(FunctionName::Update)
            ->setModelName(ModelName::UserProfile)
            ->setData(new UserProfileResource($profile))
            ->successResponse();
    }
}
