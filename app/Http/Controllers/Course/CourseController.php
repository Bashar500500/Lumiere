<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Response\ResponseController;
use App\Services\Course\CourseService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Course\CourseRequest;
use App\Http\Resources\Course\CourseResource;
use App\Enums\Trait\FunctionName;
use App\Enums\Trait\ModelName;
use App\Models\Course\Course;

class CourseController extends Controller
{
    public function __construct(
        ResponseController $controller,
        protected CourseService $service,
    ) {
        parent::__construct($controller);
    }

    public function index(CourseRequest $request): JsonResponse
    {
        $data = (object) CourseResource::collection(
            $this->service->index($request),
        );

        return $this->controller->setFunctionName(FunctionName::Index)
            ->setModelName(ModelName::Course)
            ->setData($data)
            ->successResponse();
    }

    public function show(Course $course): JsonResponse
    {
        $data = CourseResource::make(
            $this->service->show($course),
        );

        return $this->controller->setFunctionName(FunctionName::Show)
            ->setModelName(ModelName::Course)
            ->setData($data)
            ->successResponse();
    }

    public function store(CourseRequest $request): JsonResponse
    {
        $data = CourseResource::make(
            $this->service->store($request),
        );

        return $this->controller->setFunctionName(FunctionName::Store)
            ->setModelName(ModelName::Course)
            ->setData($data)
            ->successResponse();
    }

    public function update(CourseRequest $request, Course $course): JsonResponse
    {
        $data = CourseResource::make(
            $this->service->update($request, $course),
        );

        return $this->controller->setFunctionName(FunctionName::Update)
            ->setModelName(ModelName::Course)
            ->setData($data)
            ->successResponse();
    }

    public function destroy(Course $course): JsonResponse
    {
        $data = CourseResource::make(
            $this->service->destroy($course),
        );

        return $this->controller->setFunctionName(FunctionName::Delete)
            ->setModelName(ModelName::Course)
            ->setData($data)
            ->successResponse();
    }
}
