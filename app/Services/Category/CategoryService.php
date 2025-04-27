<?php

namespace App\Services\Category;

use App\DataTransferObjects\Category\CategoryDto;
use App\Http\Requests\Category\CategoryRequest;
use App\Models\Category\Category;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryService
{

    public function __construct(
        protected CategoryRepositoryInterface $repository,
    ) {}

    public function index(CategoryRequest $request): object
    {
        $dto = CategoryDto::fromIndexRequest($request);
        return $this->repository->all($dto);
    }

    public function show(Category $category): object
    {
        return $this->repository->find($category->id);
    }

    public function store(CategoryRequest $request): object
    {
        $dto = CategoryDto::fromStoreRequest($request);
        return $this->repository->create($dto);
    }


    public function update(CategoryRequest $request, Category $message): object
    {
        $dto = CategoryDto::fromUpdateRequest($request);
        return $this->repository->update($dto, $message->id);
    }

    public function destroy(Category $message): object
    {
        return $this->repository->delete($message->id);
    }
}
