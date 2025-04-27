<?php

namespace App\Repositories\SubCategory;

use App\DataTransferObjects\SubCategory\SubCategoryDto;

interface SubCategoryRepositoryInterface
{
    public function all(SubCategoryDto $dto): object;

    public function find(int $id): object;

    public function create(SubCategoryDto $dto): object;

    public function update(SubCategoryDto $dto, int $id): object;

    public function delete(int $id): object;
}
