<?php

namespace App\Services\User;

use App\DataTransferObjects\UserProfile\UserProfileDto;
use App\Http\Requests\UserProfile\UserProfileRequest;
use App\Repositories\UserProfile\UserProfileRepositoryInterface;
use Illuminate\Auth\Access\Response;

class UserProfileService
{
    public function __construct(
        protected UserProfileRepositoryInterface $repository
    ) {}

    public function store(UserProfileRequest $request, int $userId): object
    {
        $dto = UserProfileDto::fromProfileRequest($request);

        $existingProfile = $this->repository->findByUserId($userId);
        if ($existingProfile) {
            abort(response()->json([
                'message' => 'User profile already exists.'
            ], 422));
        }
        return $this->repository->create($userId, $dto);
    }

    public function update(UserProfileRequest $request, int $userId): object
    {
        $dto = UserProfileDto::fromUpdateProfileRequest($request);
        return $this->repository->update($userId, $dto);
    }

    public function show(int $userId): ?object
    {
        return $this->repository->findByUserId($userId);
    }
}