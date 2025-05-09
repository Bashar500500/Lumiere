<?php

namespace App\Services\Permission;

use App\DataTransferObjects\Permission\PermissionDto;
use App\DataTransferObjects\Permission\UserPermissionDto;
use App\Http\Requests\Permission\PermissionRequest;
use App\Http\Requests\Permission\PermissionToUserRequest;
use App\Models\User\User;
use App\Repositories\Permission\PermissionRepositoryInterface;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionService
{
    public function __construct(
        protected PermissionRepositoryInterface $repository
    ) {}

    public function index(PermissionRequest $request): object
    {
        $dto = PermissionDto::fromindexPermissionRequest($request);
        return $this->repository->all($dto);
    }

    public function getPermissionsByRole(Role $role): object
    {
        return $this->repository->findByRole($role);
    }

    public function getPermissionsByUser(User $user): object
    {
        return $this->repository->findByUser($user->id);
    }
    public function create(PermissionRequest $request): object
    {

        $dto = PermissionDto::frompermissionRequest($request);
        $permission = $this->repository->create($dto);
        return (object)[
            'permission' => $permission,
        ];
    }

    public function update(PermissionRequest $request, Permission $permission): object
    {
        $dto = PermissionDto::frompermissionRequest($request);
        return $this->repository->update($dto, $permission->id);
    }
    public function destroy(Permission $permission): object
    {
        return $this->repository->delete($permission->id);
    }

    public function assignPermissionToUser(PermissionToUserRequest $request)
    {
        $dto = UserPermissionDto::fromPermissionToUserRequest($request);
        return $this->repository->assign($dto);
    }

    public function revokePermissionToUser(PermissionToUserRequest $request)
    {
        $dto = UserPermissionDto::fromPermissionToUserRequest($request);
        return $this->repository->revoke($dto);
    }
}
