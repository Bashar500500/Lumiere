<?php

namespace App\DataTransferObjects\Permission;

use App\Enums\Auth\UserRole;
use App\Http\Requests\Permission\PermissionToUserRequest;

class UserPermissionDto
{
    public function __construct(
        public readonly int $user_id,
        public readonly string $permission,
    ) {}

    public static function fromPermissionToUserRequest(PermissionToUserRequest $request): self
    {
        return new self(
            user_id: $request->validated('user_id'),
            permission: $request->validated('permission'),
        );
    }
}
