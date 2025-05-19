<?php

namespace App\Http\Resources\Course;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseDiscussionFeatureResource extends JsonResource
{
    public static function makeJson(
        CourseResource $courseResource,
    ): array
    {
        return [
            'attach_files' => $courseResource->features_discussion_features_attach_files == 0 ? 'false' : 'true',
            'create_topics' => $courseResource->features_discussion_features_create_topics == 0 ? 'false' : 'true',
            'edit_replies' => $courseResource->features_discussion_features_edit_replies == 0 ? 'false' : 'true',
        ];
    }
}
