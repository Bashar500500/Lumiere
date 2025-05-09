<?php
namespace App\Services\User;

use App\DataTransferObjects\User\AssignRoleDto;
use App\Http\Requests\User\AssignRoleRequest;
use App\Repositories\User\UserRepositoryInterface;

class AssignRoleService
{
    public function __construct(
        protected UserRepositoryInterface $repository
        ) {}

    public function createAssignRole(AssignRoleRequest $request)
    {
        // $dto = AssignRoleDto::fromCreateRoleRequest($request);
        // return $this->repository->createRole($dto);
    }
}