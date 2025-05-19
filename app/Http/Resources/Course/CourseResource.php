<?php

namespace App\Http\Resources\Course;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'instructor_id' => $this->instructor_id,
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'language' => $this->language,
            'level' => $this->level,
            'timezone' => $this->timezone,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'cover_image' => $this->whenLoaded('attachment') ? $this->whenLoaded('attachment')->url : null,
            'status' => $this->status,
            'duration' => $this->duration,
            'price' => $this->price,
            'access_settings' => CourseAccessSettingResource::makeJson($this),
            'features' => CourseFeatureResource::makeJson($this),
        ];
    }
}
