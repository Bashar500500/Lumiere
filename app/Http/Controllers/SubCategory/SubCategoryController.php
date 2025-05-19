<?php

namespace App\Http\Controllers\SubCategory;

use App\Enums\Trait\FunctionName;
use App\Enums\Trait\ModelName;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Response\ResponseController;
use App\Http\Requests\SubCategory\SubCategoryRequest;
use App\Http\Resources\SubCategory\SubCategoryResource;
use App\Models\SubCategory\SubCategory;
use App\Services\SubCategory\SubCategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function __construct(
        ResponseController $controller,
        protected SubCategoryService $service,
    ) {
        parent::__construct($controller);
    }

    public function index(SubCategoryRequest $request): JsonResponse
    {
        $data = (object) SubCategoryResource::collection(
            $this->service->index($request),
        );

        return $this->controller->setFunctionName(FunctionName::Index)
            ->setModelName(ModelName::SubCategory)
            ->setData($data)
            ->successResponse();
    }

    public function show(SubCategory $sub_category): JsonResponse
    {
        $data = SubCategoryResource::make(
            $this->service->show($sub_category),
        );

        return $this->controller->setFunctionName(FunctionName::Show)
            ->setModelName(ModelName::SubCategory)
            ->setData($data)
            ->successResponse();
    }

    public function store(SubCategoryRequest $request): JsonResponse
    {
        $data = SubCategoryResource::make(
            $this->service->store($request),
        );

        return $this->controller->setFunctionName(FunctionName::Store)
            ->setModelName(ModelName::SubCategory)
            ->setData($data)
            ->successResponse();
    }

    public function update(SubCategoryRequest $request, SubCategory $sub_category): JsonResponse
    {
        $data = SubCategoryResource::make(
            $this->service->update($request, $sub_category),
        );

        return $this->controller->setFunctionName(FunctionName::Update)
            ->setModelName(ModelName::SubCategory)
            ->setData($data)
            ->successResponse();
    }

    public function destroy(SubCategory $sub_category): JsonResponse
    {
        $data = SubCategoryResource::make(
            $this->service->destroy($sub_category),
        );

        return $this->controller->setFunctionName(FunctionName::Delete)
            ->setModelName(ModelName::SubCategory)
            ->setData($data)
            ->successResponse();
    }
}
