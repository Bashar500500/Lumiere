<?php

namespace App\Services\User;
use App\DataTransferObjects\Auth\RegisterDto;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\User\UserRepository;

class UserService
{
    public function __construct(
        protected UserRepository $repository
    ) {}

    public function register(RegisterRequest $request): object
    {
        $dto = RegisterDto::fromRegisterRequest($request);
        $user = $this->repository->create($dto);

        $user['token'] = $user->createToken('api_token')->accessToken;

        return (object)[
            'user' => $user,
        ];
    }
}
