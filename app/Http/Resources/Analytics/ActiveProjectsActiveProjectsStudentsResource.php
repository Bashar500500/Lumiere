<?php

namespace App\Http\Resources\Project;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ActiveProjectsActiveProjectsStudentsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            // 'image' => $this->student->profile->load('attachment')->url ? $this->student->profile->load('attachment')->url : null,
            'name' => $this->student->first_name . ' ' . $this->student->last_name,
            'avatar' => $this->student->profile->load('attachment')->url ?
                $this->prepareAttachmentData($this->student->profile->id, $this->student->profile->load('attachment')->url)
                : null,
        ];
    }

    private function prepareAttachmentData(int $id, string $url): string
    {
        $file = Storage::disk('supabase')->get('Profile/' . $id . '/Images/' . $url);
        $mimeType = Storage::disk('supabase')->mimeType('Profile/' . $id . '/Images/' . $url);
        return 'data:' . $mimeType . ';base64,' . $file;
    }
}
