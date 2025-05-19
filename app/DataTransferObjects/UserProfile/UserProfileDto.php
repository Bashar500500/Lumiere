<?php
namespace App\DataTransferObjects\UserProfile;

use App\Enums\User\Gender;
use App\Http\Requests\UserProfile\UserProfileRequest;

class UserProfileDto
{
    
    public function __construct(
        public readonly ?string $phone,
        public readonly ?string $address,
        public readonly ?string $avatar,
        public readonly ?Gender $gender,
        public readonly ?string $birthdate,
    ) {}

    public static function fromProfileRequest(UserProfileRequest $request): self
    {
        return new self(
            phone: $request->validated('phone'),
            address: $request->validated('address'),
            avatar: $request->validated('avatar'),
            gender: Gender::from($request->validated('gender')),
            birthdate: $request->validated('birthdate'),
        );
    }

    public static function fromUpdateProfileRequest(UserProfileRequest $request): self
    {
        return new self(
            phone: $request->validated('phone'),
            address: $request->validated('address'),
            avatar: $request->validated('avatar'),
            gender: Gender::from($request->validated('gender')),
            birthdate: $request->validated('birthdate'),
        );
    }
}