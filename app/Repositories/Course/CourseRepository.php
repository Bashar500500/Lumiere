<?php

namespace App\Repositories\Course;

use App\Repositories\BaseRepository;
use App\Models\Course\Course;
use App\DataTransferObjects\Course\CourseDto;
use Illuminate\Support\Facades\DB;
use App\Enums\Attachment\AttachmentReferenceField;
use App\Enums\Attachment\AttachmentType;

class CourseRepository extends BaseRepository implements CourseRepositoryInterface
{
    public function __construct(Course $course) {
        parent::__construct($course);
    }

    public function all(CourseDto $dto): object
    {
        return (object) $this->model->where('user_id', $dto->userId)
            ->with('attachments')
            ->latest('created_at')
            ->simplePaginate(
                $dto->pageSize,
                ['*'],
                'page',
                $dto->currentPage,
            );
    }

    public function find(int $id): object
    {
        return (object) parent::find($id)
            ->load('attachments');
    }

    public function create(CourseDto $dto, array $data): object
    {
        $course = DB::transaction(function () use ($dto, $data) {
            $course = (object) $this->model->create([
                'user_id' => $data['userId'],
                'name' => $dto->name,
                'description' => $dto->description,
                'category_id' => $dto->categoryId,
                'language' => $dto->language,
                'level' => $dto->level,
                'timezone' => $dto->timezone,
                'start_date' => $dto->startDate,
                'end_date' => $dto->endDate,
                'status' => $dto->status,
                'duration' => $dto->duration,
                'price' => $dto->price,
                'access_settings_access_type' => $dto->accessType,
                'access_settings_price_hidden' => $dto->priceHidden,
                'access_settings_is_secret' => $dto->isSecret,
                'access_settings_enrollment_limit_enabled' => $dto->enrollmentLimitEnabled,
                'access_settings_enrollment_limit_limit' => $dto->enrollmentLimitLimit,
                'features_personalized_learning_paths' => $dto->personalizedLearningPaths,
                'features_certificate_requires_submission' => $dto->certificateRequiresSubmission,
                'features_discussion_features_attach_files' => $dto->attachFiles,
                'features_discussion_features_create_topics' => $dto->createTopics,
                'features_discussion_features_edit_replies' => $dto->editReplies,
                'features_student_groups' => $dto->studentGroups,
                'features_is_featured' => $dto->isFeatured,
                'features_show_progress_screen' => $dto->showProgressScreen,
                'features_hide_grade_totals' => $dto->hideGradeTotals,
            ]);

            if ($dto->coverImage)
            {
                // here the code for storing in firebase

                $course->attachment()->create([
                    'reference_field' => AttachmentReferenceField::CoverImage,
                    'type' => AttachmentType::Image->getType(),
                    'url' => 'https:\\firebase.com\storedinfirebase',
                ]);
            }

            return $course;
        });

        return (object) $course->load('attachments');
    }

    public function update(CourseDto $dto, int $id): object
    {
        $model = (object) parent::find($id);

        $course = DB::transaction(function () use ($dto, $model) {
            $course = tap($model)->update([
                'name' => $dto->name,
                'description' => $dto->description,
                'category_id' => $dto->categoryId,
                'language' => $dto->language,
                'level' => $dto->level,
                'timezone' => $dto->timezone,
                'start_date' => $dto->startDate,
                'end_date' => $dto->endDate,
                'status' => $dto->status,
                'duration' => $dto->duration,
                'price' => $dto->price,
                'access_settings_access_type' => $dto->accessType,
                'access_settings_price_hidden' => $dto->priceHidden,
                'access_settings_is_secret' => $dto->isSecret,
                'access_settings_enrollment_limit_enabled' => $dto->enrollmentLimitEnabled,
                'access_settings_enrollment_limit_limit' => $dto->enrollmentLimitLimit,
                'features_personalized_learning_paths' => $dto->personalizedLearningPaths,
                'features_certificate_requires_submission' => $dto->certificateRequiresSubmission,
                'features_discussion_features_attach_files' => $dto->attachFiles,
                'features_discussion_features_create_topics' => $dto->createTopics,
                'features_discussion_features_edit_replies' => $dto->editReplies,
                'features_student_groups' => $dto->studentGroups,
                'features_is_featured' => $dto->isFeatured,
                'features_show_progress_screen' => $dto->showProgressScreen,
                'features_hide_grade_totals' => $dto->hideGradeTotals,
            ]);

            // here the code for updating in firebase

            $course->attachment()->update([
                'url' => 'updatedhttps:\\firebase.com\storedinfirebase',
            ]);

            return $course;
        });

        return (object) $course->load('attachments');
    }

    public function delete(int $id): object
    {
        $course = DB::transaction(function () use ($id) {
            return parent::delete($id);
        });

        return (object) $course;
    }
}
