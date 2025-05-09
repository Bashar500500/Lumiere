<?php
namespace App\DataTransferObjects\User;

use App\Http\Requests\Permission\PermissionRequest;
use App\Http\Requests\User\UserRequest;

class UserDto
{
    public function __construct(
        public readonly ?int $currentPage,
        public readonly ?int $pageSize,
    ) {}
    
    public static function fromindexRequest(UserRequest $request): UserDto
    {
        return new self(
            currentPage: $request->validated('page'),
            pageSize: $request->validated('page_size'),
        );
    }
}