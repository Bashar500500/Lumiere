<?php

namespace App\Http\Resources\Course;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Attachment\AttachmentResource;

class CourseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'language' => $this->language,
            'level' => $this->level,
            'timezone' => $this->timezone,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
            'duration' => $this->duration,
            'price' => $this->price,
            'access_type' => $this->access_settings_access_type,
            'price_hidden' => $this->access_settings_price_hidden,
            'is_secret' => $this->access_settings_is_secret,
            'enrollment_limit_enabled' => $this->access_settings_enrollment_limit_enabled,
            'enrollment_limit_limit' => $this->access_settings_enrollment_limit_limit,
            'personalized_learning_paths' => $this->features_personalized_learning_paths,
            'certificate_requires_submission' => $this->features_certificate_requires_submission,
            'attach_files' => $this->features_discussion_features_attach_files,
            'create_topics' => $this->features_discussion_features_create_topics,
            'edit_replies' => $this->features_discussion_features_edit_replies,
            'student_groups' => $this->features_student_groups,
            'is_featured' => $this->features_is_featured,
            'show_progress_screen' => $this->features_show_progress_screen,
            'hide_grade_totals' => $this->features_hide_grade_totals,
            'attachments' => AttachmentResource::collection($this->whenLoaded('attachments')),
        ];
    }
}
