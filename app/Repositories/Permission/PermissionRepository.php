<?php

namespace App\Repositories\Permission;

use App\DataTransferObjects\Permission\PermissionDto;
use App\DataTransferObjects\Permission\UserPermissionDto;
use App\Enums\Trait\ModelName;
use App\Exceptions\CustomException;
use App\Models\User\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    public function __construct(Permission $permission)
    {
        parent::__construct($permission);
    }

    public function all(PermissionDto $dto): object
    {
        return (object) $this->model
            ->simplePaginate(
                $dto->pageSize,
                ['*'],
                'page',
                $dto->currentPage,
            );
    }

    public function findByRole(Role $role): object
    {
        $role = Role::findByName($role->name);
        return $role->getAllPermissions();
    }

    public function findByUser(int $id): object
    {
        $user = User::findOrFail($id);
        return $user->getAllPermissions();
    }

    public function create(PermissionDto $dto): Permission
    {
        $permission = DB::transaction(function () use ($dto) {
            $permission = $this->model->create([
                'name' => $dto->name,
                'guard_name' => $dto->guard_name,
            ]);
            $role = Role::where('name', $dto->role)
                ->where('guard_name', $dto->guard_name)
                ->firstOrFail();
            $role->givePermissionTo($permission);
            $permission['role'] = $role->name;

            return $permission;
        });
        return $permission;
    }

    public function update(PermissionDto $dto, int $id): object
    {
        return DB::transaction(function () use ($id, $dto) {
            $permission = $this->model->findOrFail($id);

            $permission->update([
                'name' => $dto->name,
                'guard_name' => $dto->guard_name,
            ]);
            if ($dto->role) {
                foreach ($permission->roles as $role) {
                    $role->revokePermissionTo($permission);
                }
                $newRole = Role::where('name', $dto->role)
                    ->where('guard_name', $dto->guard_name)
                    ->firstOrFail();

                $newRole->givePermissionTo($permission);

                $permission['role'] = $newRole->name;
            }

            return $permission;
        });
    }

    public function delete(int $id): Permission
    {
        return DB::transaction(function () use ($id) {
            $permission = $this->model->findOrFail($id);
    
            foreach ($permission->users as $user) {
                $user->revokePermissionTo($permission);
            }
    
            foreach ($permission->roles as $role) {
                $role->revokePermissionTo($permission);
            }
    
            $permission->delete();
    
            return $permission;
        });
    }

    public function assign(UserPermissionDto $dto): object
    {
        $permission = DB::transaction(function () use ($dto) {
            $user = User::findOrFail($dto->user_id);
            if ($user->hasPermissionTo($dto->permission)) {
                throw CustomException::alreadyExists(ModelName::Permission);
            }
            $permission = $user->givePermissionTo($dto->permission);
            return $permission;
        });
        return $permission;
    }

    public function revoke(UserPermissionDto $dto): object
    {
        $permission = DB::transaction(function () use ($dto) {
            $user = User::findOrFail($dto->user_id);
            if (!$user->hasPermissionTo($dto->permission)) {
                throw CustomException::NotFoundEmail(ModelName::Permission);
            }
            $permission = $user->revokePermissionTo($dto->permission);
            return $permission;
        });
        return $permission;
    }
}
