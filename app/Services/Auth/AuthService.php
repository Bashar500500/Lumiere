<?php

namespace App\Services\Auth;

use App\DataTransferObjects\Auth\LoginDto;
use App\Enums\Trait\ModelName;
use App\Exceptions\CustomException;
use App\Exceptions\InternalException;
use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Auth;

class AuthService
{

    public function login(LoginRequest $request): object
    {
        $dto = LoginDto::fromLoginRequest($request);

        if (!Auth::attempt(['email' => $dto->email, 'password' => $dto->password])) {
            // throw InternalException('Unauthorized', 'Invalid credentials');
            throw CustomException::unauthorized(ModelName::User);
        }

        $user = Auth::user();
        $user['token'] = $user->createToken('api_token')->accessToken;
        $user['role']= $user->getRoleNames();
        return (object) [
            'user' => $user,
        ];
    }

    public function logout(): void
    {
        Auth::user()->token()->revoke();
    }
}
