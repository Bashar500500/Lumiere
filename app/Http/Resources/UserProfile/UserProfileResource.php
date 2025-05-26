<?php

namespace App\Http\Resources\UserProfile;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'phone' => $this->phone,
            'address' => $this->address,
            'avatar' => $this->avatar,
            'gender' => $this->gender,
            'birthdate' => $this->birthdate,
            'courses' => UserProfileCoursesResource::collection($this->whenLoaded('courses')),
            'groups' => UserProfileGroupsResource::collection($this->whenLoaded('groups')),
        ];
    }
}
