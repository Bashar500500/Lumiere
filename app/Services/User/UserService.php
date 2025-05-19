<?php

namespace App\Services\User;
use App\DataTransferObjects\Auth\RegisterDto;
use App\DataTransferObjects\User\UserDto;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\User\UserRequest;
use App\Models\User\User;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;

class UserService
{
    public function __construct(
        protected UserRepositoryInterface $repository
    ) {}

    public function index(UserRequest $request): object
    {
        $dto = UserDto::fromindexRequest($request);
        return $this->repository->all($dto);
    }

    public function show(User $user): object
    {
        return $this->repository->find($user->id);
    }

    public function register(RegisterRequest $request): object
    {
        $dto = RegisterDto::fromRegisterRequest($request);
        $user = $this->repository->create($dto);
        $user['token'] = $user->createToken('api_token')->accessToken;
        $user['role']= $user->getRoleNames();
        return (object)[
            'user' => $user,
        ];
    }

}
