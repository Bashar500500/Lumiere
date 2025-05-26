<?php

namespace App\Http\Resources\ScheduleTiming;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleTimingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'instructorName' => $this->whenLoaded('instructor')->name, // check it
            // 'instructorImage' => $this->whenLoaded('instructor')->name, // check it
            'course' => $this->whenLoaded('course')->name,
            'instructorAvailableTimings' => $this->instructor_available_timings,
        ];
    }
}
