<?php

namespace App\DataTransferObjects\Auth;

use App\Enums\Category\UserRole;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

class LoginDto
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly ?string $email,
        public readonly ?string $password,
    ) {}

    public static function fromLoginRequest(LoginRequest $request): LoginDto
    {
        return new self(
            email: $request->validated('email'),
            password: $request->validated('password'),
        );
    }
}
