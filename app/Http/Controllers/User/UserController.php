<?php

namespace App\Http\Controllers\User;

use App\Enums\Trait\FunctionName;
use App\Enums\Trait\ModelName;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Response\ResponseController;
use App\Http\Requests\User\UserRequest;
use Illuminate\Http\JsonResponse;
use App\Models\User\User;
use App\Services\User\UserService;
use App\Enums\User\UserMessage;

class UserController extends Controller
{
    public function __construct(
        ResponseController $controller,
        protected UserService $service,
    ) {
        parent::__construct($controller);
    }

    public function index(UserRequest $request): JsonResponse
    {
        $users = $this->service->index($request);

        return $this->controller
            ->setFunctionName(FunctionName::Index)
            ->setModelName(ModelName::User)
            ->setData($users)
            ->successResponse();
    }

    public function show(User $user): JsonResponse
    {
        $user = $this->service->show($user);

        return $this->controller
            ->setFunctionName(FunctionName::Show)
            ->setModelName(ModelName::User)
            ->setData($user)
            ->successResponse();
    }

    public function addStudentToCourse(UserRequest $request): JsonResponse
    {
        $message = $this->service->addStudentToCourse($request);

        return match ($message) {
            UserMessage::StudentAddedToCourse => $this->controller->setFunctionName(FunctionName::AddStudentToCourse)
                ->setModelName(ModelName::Student)
                ->setData((object) [])
                ->successResponse(),
            UserMessage::StudentCreatedAccountAndAddedToCourse => $this->controller->setFunctionName(FunctionName::AddStudentToCourse)
                ->setModelName(ModelName::Student)
                ->setData((object) [])
                ->successResponse(),
        };
    }
}
