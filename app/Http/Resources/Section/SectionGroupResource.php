<?php

namespace App\Http\Resources\Section;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class SectionGroupResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'courseId' => $this->course_id,
            'name' => $this->name,
            'description' => $this->description,
            // 'imageUrl' => $this->whenLoaded('attachment') ? $this->whenLoaded('attachment')->url : null,
            'imageUrl' => $this->whenLoaded('attachment') ?
                $this->prepareAttachmentData($this->id, $this->whenLoaded('attachment')->url)
                : null,
            'capacity' => SectionGroupCapacityResource::makeJson($this),
            'instructorId' => $this->whenLoaded('course')->instructor->id,
            'students' => $this->whenLoaded('students')->select('id'),
        ];
    }

    private function prepareAttachmentData(int $id, string $url): string
    {
        $file = Storage::disk('local')->path('Group/' . $id . '/Images/' . $url);
        $data = base64_encode(file_get_contents($file));
        $metadata = mime_content_type($file);
        return 'data:' . $metadata . ';base64,' . $data;
    }
}
