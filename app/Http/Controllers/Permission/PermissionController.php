<?php

namespace App\Http\Controllers\Permission;

use App\Enums\Trait\FunctionName;
use App\Enums\Trait\ModelName;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Response\ResponseController;
use App\Http\Requests\Permission\PermissionRequest;
use App\Models\User\User;
use App\Services\Permission\PermissionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function __construct(
        ResponseController $controller,
        protected PermissionService $service
    ) {
        parent::__construct($controller);
    }

    public function store(PermissionRequest $request): JsonResponse
    {

        $permission = $this->service->create($request);
        return $this->controller
            ->setFunctionName(FunctionName::Store)
            ->setModelName(ModelName::Permission)
            ->setData($permission)
            ->successResponse();
    }

    public function index(PermissionRequest $request): JsonResponse
    {
        $permissions = $this->service->index($request);
        return $this->controller
            ->setFunctionName(FunctionName::Index)
            ->setModelName(ModelName::Permission)
            ->setData($permissions)
            ->successResponse();
    }

    public function getPermissionsByRole(Role $role): JsonResponse
    {
        $permissions = $this->service->getPermissionsByRole($role);
        return $this->controller
            ->setFunctionName(FunctionName::Show)
            ->setModelName(ModelName::Permission)
            ->setData($permissions)
            ->successResponse();
    }

    public function getPermissionsByUser(User $user): JsonResponse
    {
        $permissions = $this->service->getPermissionsByUser($user);
        return $this->controller
            ->setFunctionName(FunctionName::Show)
            ->setModelName(ModelName::Permission)
            ->setData($permissions)
            ->successResponse();
    }
    public function update(PermissionRequest $request, Permission $permission): JsonResponse
    {
        $updated = $this->service->update($request, $permission);
        return $this->controller
        ->setFunctionName(FunctionName::Update)
        ->setModelName(ModelName::Permission)
        ->setData($updated)
        ->successResponse();
    }

    public function destroy(Permission $permission): JsonResponse
    {
        $permissions=$this->service->destroy($permission);
        return $this->controller
            ->setFunctionName(FunctionName::Delete)
            ->setModelName(ModelName::Permission)
            ->setData($permissions)
            ->successResponse();
    }
}
