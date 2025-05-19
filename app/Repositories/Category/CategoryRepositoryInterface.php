<?php

namespace App\Repositories\Category;

use App\DataTransferObjects\Category\CategoryDto;

interface CategoryRepositoryInterface
{
    public function all(CategoryDto $dto): object;

    public function find(int $id): object;

    public function create(CategoryDto $dto): object;

    public function update(CategoryDto $dto, int $id): object;

    public function delete(int $id): object;
}
