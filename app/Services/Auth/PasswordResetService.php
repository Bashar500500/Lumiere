<?php

namespace App\Services\Auth;

use App\DataTransferObjects\Auth\SendResetCodeDto;
use App\Enums\Trait\ModelName;
use App\Exceptions\CustomException;
use App\Exceptions\InternalException;
use App\Http\Requests\Auth\SendResetCodeRequest;
use App\Http\Requests\Auth\VerifyResetCodeRequest;
use App\Models\User\PasswordResetCode;
use App\Models\User\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class PasswordResetService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {}

    public function sendCode(SendResetCodeRequest $request): void
    {
        $dto = SendResetCodeDto::fromSendResetRequest($request);
        $code = rand(100000, 999999);
        if (! User::where('email', $dto->email)->first()) {
            throw CustomException::NotFoundEmail(ModelName::User);
        }
        PasswordResetCode::updateOrCreate(
            ['email' => $dto->email],
            ['code' => $code, 'created_at' => now()]
        );

        Mail::raw("Your password reset code is: $code", function ($message) use ($dto) {
            $message->to($dto->email)->subject('Password Reset Code');
        });
    }

    public function verifyCode(VerifyResetCodeRequest $request): void
    {
        $dto = SendResetCodeDto::fromVerifyResetRequest($request);
        $reset = PasswordResetCode::where('email', $dto->email)
            ->where('code', $dto->code)
            ->first();

        if (!$reset || Carbon::parse($reset->created_at)->addDay()->isPast()) {
            throw CustomException::BadRequest(ModelName::User);
        }

        $this->userRepository->updatePassword($dto->email, $dto->password);
        $reset->delete();
    }
}
