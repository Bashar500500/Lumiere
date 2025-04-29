<?php

namespace App\Services\Auth;

use App\DataTransferObjects\Auth\LoginDto;
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
            throw new InternalException('Unauthorized', 'Invalid credentials');
        }

        $user = Auth::user();
        $user['token'] = $user->createToken('api_token')->accessToken;

        return (object) [
            'user' => $user,
        ];
    }

    public function logout(): void
    {
        Auth::user()->currentAccessToken()->delete();
    }
}
