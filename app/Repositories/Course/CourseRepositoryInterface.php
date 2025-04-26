<?php

namespace App\Repositories\Course;

use App\DataTransferObjects\Course\CourseDto;

interface CourseRepositoryInterface
{
    public function all(CourseDto $dto): object;

    public function find(int $id): object;

    public function create(CourseDto $dto, array $data): object;

    public function update(CourseDto $dto, int $id): object;

    public function delete(int $id): object;
}
