<?php
namespace App\DataTransferObjects\Permission;

use App\Enums\Auth\UserRole;
use App\Http\Requests\Permission\PermissionRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Contracts\Permission;

class PermissionDto
{
    public function __construct(
        public readonly ?string $name,
        public readonly ?string $guard_name,
        public readonly ?UserRole $role,
        public readonly ?int $currentPage,
        public readonly ?int $pageSize,
    ) {}
    
    public static function frompermissionRequest(PermissionRequest $request): PermissionDto
    {
        return new self(
            name: $request->validated('name'),
            guard_name: $request->validated('guard_name'),
            role: UserRole::from($request->validated('role')),
            currentPage: null,
            pageSize: null,
        );
    }

    public static function fromindexPermissionRequest(PermissionRequest $request): PermissionDto
    {
        return new self(
            name: null,
            guard_name: null,
            role: null,
            currentPage: $request->validated('page'),
            pageSize: $request->validated('page_size'),
        );
    }
}