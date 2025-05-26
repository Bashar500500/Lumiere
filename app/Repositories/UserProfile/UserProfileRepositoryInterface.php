<?php

namespace App\Repositories\UserProfile;

use App\DataTransferObjects\UserProfile\UserProfileDto;
use App\Models\User\UserProfile;

interface UserProfileRepositoryInterface
{
    public function create(int $userId, UserProfileDto $dto): object;
    public function update(int $userId, UserProfileDto $dto): object;
    public function findByUserId(int $userId): ?UserProfile;

    public function find(int $id): object;
}
