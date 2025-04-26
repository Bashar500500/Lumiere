<?php

namespace App\Services\Course;

use App\Repositories\Course\CourseRepositoryInterface;
use App\Http\Requests\Course\CourseRequest;
use App\Models\Course\Course;
use App\DataTransferObjects\Course\CourseDto;

class CourseService
{
    public function __construct(
        protected CourseRepositoryInterface $repository,
    ) {}

    public function index(CourseRequest $request): object
    {
        $dto = CourseDto::fromIndexRequest($request);
        return $this->repository->all($dto);
    }

    public function show(Course $course): object
    {
        return $this->repository->find($course->id);
    }

    public function store(CourseRequest $request): object
    {
        $dto = CourseDto::fromStoreRequest($request);
        $data = $this->prepareStoreData();
        return $this->repository->create($dto, $data);
    }

    public function update(CourseRequest $request, Course $course): object
    {
        $dto = CourseDto::fromUpdateRequest($request);
        return $this->repository->update($dto, $course->id);
    }

    public function destroy(Course $course): object
    {
        return $this->repository->delete($course->id);
    }

    private function prepareStoreData(): array
    {
        return [
            // 'userId' => auth()->user()->id
            'userId' => 1,
        ];
    }
}
