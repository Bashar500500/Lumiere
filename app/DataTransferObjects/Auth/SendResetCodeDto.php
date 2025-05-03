<?php

namespace App\DataTransferObjects\Auth;

use App\Http\Requests\Auth\SendResetCodeRequest;
use App\Http\Requests\Auth\VerifyResetCodeRequest;

class SendResetCodeDto
{
    public function __construct(
        public string $email,
        public ?string $code,
        public ?string $password
    ) {}

    public static function fromVerifyResetRequest(VerifyResetCodeRequest $request): self
    {
        return new self(
            email: $request->validated('email'),
            code: $request->validated('code'),
            password: $request->validated('password'),
        );
    }
    public static function fromSendResetRequest(SendResetCodeRequest $request): self
    {
        return new self(
            email: $request->validated('email'),
            code: null,
            password: null,
        );
    }
}