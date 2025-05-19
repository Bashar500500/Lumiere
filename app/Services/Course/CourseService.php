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

    public function view(Course $course): string
    {
        return $this->repository->view($course->id);
    }

    public function download(Course $course): string
    {
        return $this->repository->download($course->id);
    }

    public function destroyAttachment(Course $course): void
    {
        $this->repository->deleteAttachment($course->id);
    }

    private function prepareStoreData(): array
    {
        return [
            // 'instructorId' => auth()->user()->id
            'instructorId' => 1,
        ];
    }
}
