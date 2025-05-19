<?php

namespace App\Http\Resources\Course;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseFeatureResource extends JsonResource
{
    public static function makeJson(
        CourseResource $courseResource,
    ): array
    {
        return [
            'personalized_learning_paths' => $courseResource->features_personalized_learning_paths == 0 ? 'false' : 'true',
            'certificate_requires_submission' => $courseResource->features_certificate_requires_submission == 0 ? 'false' : 'true',
            'discussion_features' => CourseDiscussionFeatureResource::makeJson($courseResource),
            'student_groups' => $courseResource->features_student_groups == 0 ? 'false' : 'true',
            'is_featured' => $courseResource->features_is_featured == 0 ? 'false' : 'true',
            'show_progress_screen' => $courseResource->features_show_progress_screen == 0 ? 'false' : 'true',
            'hide_grade_totals' => $courseResource->features_hide_grade_totals == 0 ? 'false' : 'true',
        ];
    }
}
