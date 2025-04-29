<?php

namespace App\DataTransferObjects\Auth;

use App\Enums\Auth\UserRole;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterDto
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly ?string $name,
        public readonly ?string $email,
        public readonly ?string $password,
        public readonly ?UserRole $role,
    ) {}

    public static function fromRegisterRequest(RegisterRequest $request): RegisterDto
    {
        return new self(
            name: $request->validated('name'),
            email: $request->validated('email'),
            password: $request->validated('password'),
            role: UserRole::from($request->validated('role')),
        );
    }
}
