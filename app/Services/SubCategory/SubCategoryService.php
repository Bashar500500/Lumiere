<?php

namespace App\Services\SubCategory;

use App\Repositories\SubCategory\SubCategoryRepositoryInterface;
use App\Http\Requests\SubCategory\SubCategoryRequest;
use App\Models\SubCategory\SubCategory;
use App\DataTransferObjects\SubCategory\SubCategoryDto;

class SubCategoryService
{
    public function __construct(
        protected SubCategoryRepositoryInterface $repository,
    ) {}

    public function index(SubCategoryRequest $request): object
    {
        $dto = SubCategoryDto::fromIndexRequest($request);
        return $this->repository->all($dto);
    }

    public function show(SubCategory $sub_category): object
    {
        return $this->repository->find($sub_category->id);
    }

    public function store(SubCategoryRequest $request): object
    {
        $dto = SubCategoryDto::fromStoreRequest($request);
        return $this->repository->create($dto);
    }

    public function update(SubCategoryRequest $request, SubCategory $sub_category): object
    {
        $dto = SubCategoryDto::fromUpdateRequest($request);
        return $this->repository->update($dto, $sub_category->id);
    }

    public function destroy(SubCategory $sub_category): object
    {
        return $this->repository->delete($sub_category->id);
    }
}
