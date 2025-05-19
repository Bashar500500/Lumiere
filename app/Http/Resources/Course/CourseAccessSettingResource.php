<?php

namespace App\Http\Resources\Course;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseAccessSettingResource extends JsonResource
{
    public static function makeJson(
        CourseResource $courseResource,
    ): array
    {
        return [
            'access_type' => $courseResource->access_settings_access_type,
            'price_hidden' => $courseResource->access_settings_price_hidden == 0 ? 'false' : 'true',
            'is_secret' => $courseResource->access_settings_is_secret == 0 ? 'false' : 'true',
            'enrollment_limit' => CourseEnrollmentLimitResource::makeJson($courseResource),
        ];
    }
}
