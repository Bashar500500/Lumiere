<?php

namespace App\Http\Controllers\Category;

use App\Enums\Trait\FunctionName;
use App\Enums\Trait\ModelName;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Response\ResponseController;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category\Category;
use App\Services\Category\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(
        ResponseController $controller,
        protected CategoryService $service,
    ) {
        parent::__construct($controller);
    }

    public function index(CategoryRequest $request): JsonResponse
    {
        $data = (object) CategoryResource::collection(
            $this->service->index($request),
        );

        return $this->controller->setFunctionName(FunctionName::Index)
            ->setModelName(ModelName::Category)
            ->setData($data)
            ->successResponse();
    }

    public function show(Category $category): JsonResponse
    {
        $data = CategoryResource::make(
            $this->service->show($category),
        );

        return $this->controller->setFunctionName(FunctionName::Show)
            ->setModelName(ModelName::Category)
            ->setData($data)
            ->successResponse();
    }

    public function store(CategoryRequest $request): JsonResponse
    {
        $data = CategoryResource::make(
            $this->service->store($request),
        );

        return $this->controller->setFunctionName(FunctionName::Store)
            ->setModelName(ModelName::Category)
            ->setData($data)
            ->successResponse();
    }

    public function destroy(Category $chat): JsonResponse
    {
        $data = CategoryResource::make(
            $this->service->destroy($chat),
        );

        return $this->controller->setFunctionName(FunctionName::Delete)
            ->setModelName(ModelName::Category)
            ->setData($data)
            ->successResponse();
    }
}
