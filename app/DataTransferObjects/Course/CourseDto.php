<?php

namespace App\DataTransferObjects\Course;

use App\Http\Requests\Course\CourseRequest;
use App\Enums\Course\CourseLanguage;
use App\Enums\Course\CourseLevel;
use App\Enums\Course\CourseStatus;
use Illuminate\Support\Carbon;
use Illuminate\Http\UploadedFile;

class CourseDto
{
    public function __construct(
        public readonly ?int $instructorId,
        public readonly ?int $currentPage,
        public readonly ?int $pageSize,
        public readonly ?string $name,
        public readonly ?string $description,
        public readonly ?int $categoryId,
        public readonly ?CourseLanguage $language,
        public readonly ?CourseLevel $level,
        public readonly ?string $timezone,
        public readonly ?Carbon $startDate,
        public readonly ?Carbon $endDate,
        public readonly ?UploadedFile $coverImage,
        public readonly ?CourseStatus $status,
        public readonly ?int $duration,
        public readonly ?float $price,
        public readonly ?CourseAccessSettingsDto $accessSettingsDto,
        public readonly ?CourseFeaturesDto $featuresDto,
    ) {}

    public static function fromIndexRequest(CourseRequest $request): CourseDto
    {
        return new self(
            instructorId: $request->validated('instructor_id'),
            currentPage: $request->validated('page'),
            pageSize: $request->validated('page_size'),
            name: null,
            description: null,
            categoryId: null,
            language: null,
            level: null,
            timezone: null,
            startDate: null,
            endDate: null,
            coverImage: null,
            status: null,
            duration: null,
            price: null,
            accessSettingsDto: null,
            featuresDto: null,
        );
    }

    public static function fromStoreRequest(CourseRequest $request): CourseDto
    {
        return new self(
            instructorId: null,
            currentPage: null,
            pageSize: null,
            name: $request->validated('name'),
            description: $request->validated('description'),
            categoryId: $request->validated('category_id'),
            language: CourseLanguage::from($request->validated('language')),
            level: CourseLevel::from($request->validated('level')),
            timezone: $request->validated('timezone'),
            startDate: Carbon::parse($request->validated('start_date')),
            endDate: Carbon::parse($request->validated('end_date')),
            coverImage: $request->validated('cover_image') ? UploadedFile::createFromBase($request->validated('cover_image')) : null,
            status: CourseStatus::from($request->validated('status')),
            duration: $request->validated('duration'),
            price: $request->validated('price'),
            accessSettingsDto: CourseAccessSettingsDto::from($request),
            featuresDto: CourseFeaturesDto::from($request),
        );
    }

    public static function fromUpdateRequest(CourseRequest $request): CourseDto
    {
        return new self(
            instructorId: null,
            currentPage: null,
            pageSize: null,
            name: $request->validated('name'),
            description: $request->validated('description'),
            categoryId: $request->validated('category_id'),
            language: CourseLanguage::from($request->validated('language')),
            level: CourseLevel::from($request->validated('level')),
            timezone: $request->validated('timezone'),
            startDate: Carbon::parse($request->validated('start_date')),
            endDate: Carbon::parse($request->validated('end_date')),
            coverImage: $request->validated('cover_image') ? UploadedFile::createFromBase($request->validated('cover_image')) : null,
            status: CourseStatus::from($request->validated('status')),
            duration: $request->validated('duration'),
            price: $request->validated('price'),
            accessSettingsDto: CourseAccessSettingsDto::from($request),
            featuresDto: CourseFeaturesDto::from($request),
        );
    }
}
