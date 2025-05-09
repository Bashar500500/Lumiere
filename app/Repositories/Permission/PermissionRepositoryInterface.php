<?php

namespace App\Repositories\Permission;

use App\DataTransferObjects\Permission\PermissionDto;
use App\DataTransferObjects\Permission\UserPermissionDto;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

interface PermissionRepositoryInterface
{
    public function all(PermissionDto $dto): object;

    public function create(PermissionDto $dto): Permission;

    public function findByUser(int $id): object;

    public function findByRole(Role $role): object;

    public function update(PermissionDto $dto, int $id): object;

    public function delete(int $id): Permission;
    
    public function assign(UserPermissionDto $dto): object;

    public function revoke(UserPermissionDto $dto): object;
}
