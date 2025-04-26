<?php

namespace App\DataTransferObjects\Course;

use App\Http\Requests\Course\CourseRequest;
use App\Enums\Course\CourseLanguage;
use App\Enums\Course\CourseLevel;
use App\Enums\Course\CourseStatus;
use App\Enums\Course\CourseAccessType;
use Illuminate\Support\Carbon;
use Illuminate\Http\UploadedFile;

class CourseDto
{
    public function __construct(
        public readonly ?int $userId,
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
        public readonly ?CourseAccessType $accessType,
        public readonly ?bool $priceHidden,
        public readonly ?bool $isSecret,
        public readonly ?bool $enrollmentLimitEnabled,
        public readonly ?int $enrollmentLimitLimit,
        public readonly ?bool $personalizedLearningPaths,
        public readonly ?bool $certificateRequiresSubmission,
        public readonly ?bool $attachFiles,
        public readonly ?bool $createTopics,
        public readonly ?bool $editReplies,
        public readonly ?bool $studentGroups,
        public readonly ?bool $isFeatured,
        public readonly ?bool $showProgressScreen,
        public readonly ?bool $hideGradeTotals,
    ) {}

    public static function fromIndexRequest(CourseRequest $request): CourseDto
    {
        return new self(
            userId: $request->validated('user_id'),
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
            accessType: null,
            priceHidden: null,
            isSecret: null,
            enrollmentLimitEnabled: null,
            enrollmentLimitLimit: null,
            personalizedLearningPaths: null,
            certificateRequiresSubmission: null,
            attachFiles: null,
            createTopics: null,
            editReplies: null,
            studentGroups: null,
            isFeatured: null,
            showProgressScreen: null,
            hideGradeTotals: null,
        );
    }

    public static function fromStoreRequest(CourseRequest $request): CourseDto
    {
        return new self(
            userId: null,
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
            accessType: CourseAccessType::from($request->validated('access_type')),
            priceHidden: $request->validated('price_hidden'),
            isSecret: $request->validated('is_secret'),
            enrollmentLimitEnabled: $request->validated('enrollment_limit_enabled'),
            enrollmentLimitLimit: $request->validated('enrollment_limit_limit'),
            personalizedLearningPaths: $request->validated('personalized_learning_paths'),
            certificateRequiresSubmission: $request->validated('certificate_requires_submission'),
            attachFiles: $request->validated('attach_files'),
            createTopics: $request->validated('create_topics'),
            editReplies: $request->validated('edit_replies'),
            studentGroups: $request->validated('student_groups'),
            isFeatured: $request->validated('is_featured'),
            showProgressScreen: $request->validated('show_progress_screen'),
            hideGradeTotals: $request->validated('hide_grade_totals'),
        );
    }

    public static function fromUpdateRequest(CourseRequest $request): CourseDto
    {
        return new self(
            userId: null,
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
            accessType: CourseAccessType::from($request->validated('access_type')),
            priceHidden: $request->validated('price_hidden'),
            isSecret: $request->validated('is_secret'),
            enrollmentLimitEnabled: $request->validated('enrollment_limit_enabled'),
            enrollmentLimitLimit: $request->validated('enrollment_limit_limit'),
            personalizedLearningPaths: $request->validated('personalized_learning_paths'),
            certificateRequiresSubmission: $request->validated('certificate_requires_submission'),
            attachFiles: $request->validated('attach_files'),
            createTopics: $request->validated('create_topics'),
            editReplies: $request->validated('edit_replies'),
            studentGroups: $request->validated('student_groups'),
            isFeatured: $request->validated('is_featured'),
            showProgressScreen: $request->validated('show_progress_screen'),
            hideGradeTotals: $request->validated('hide_grade_totals'),
        );
    }
}
