<?php

namespace App\Services\Course;

use App\Factories\Course\CourseRepositoryFactory;
use App\Http\Requests\Course\CourseRequest;
use App\Models\Course\Course;
use App\DataTransferObjects\Course\CourseDto;
use Illuminate\Support\Facades\Auth;

class CourseService
{
    public function __construct(
        protected CourseRepositoryFactory $factory,
    ) {}

    public function index(CourseRequest $request): object
    {
        $dto = CourseDto::fromIndexRequest($request);
        $data = $this->prepareIndexAndStoreData('index', 'student');
        $repository = $this->factory->make('student');
        return match ($dto->accessType) {
            null => $repository->all($dto, $data),
            default => $repository->allWithFilter($dto, $data),
        };
    }

    public function show(Course $course): object
    {
        $repository = $this->factory->make('student');
        return $repository->find($course->id);
    }

    public function store(CourseRequest $request): object
    {
        $dto = CourseDto::fromStoreRequest($request);
        $data = $this->prepareIndexAndStoreData('store', 'student');
        $repository = $this->factory->make('student');
        return $repository->create($dto, $data);
    }

    public function update(CourseRequest $request, Course $course): object
    {
        $dto = CourseDto::fromUpdateRequest($request);
        $repository = $this->factory->make('student');
        return $repository->update($dto, $course->id);
    }

    public function destroy(Course $course): object
    {
        $repository = $this->factory->make('student');
        return $repository->delete($course->id);
    }

    public function view(Course $course): string
    {
        $repository = $this->factory->make('student');
        return $repository->view($course->id);
    }

    public function download(Course $course): string
    {
        $repository = $this->factory->make('student');
        return $repository->download($course->id);
    }

    public function destroyAttachment(Course $course): void
    {
        $repository = $this->factory->make('student');
        $repository->deleteAttachment($course->id);
    }

    private function prepareStoreData(): array
    {
        return [
            // 'instructorId' => auth()->user()->id
            'instructorId' => 1,
        ];
    }

    private function prepareIndexAndStoreData(string $function, string $role): array
    {
        return match ($function)
        {
            'index' => [
                "{role}" => Auth::user(),
            ],
            'store' => [
                // 'instructorId' => auth()->user()->id
                'instructorId' => 1,
            ],
        };
    }
}
