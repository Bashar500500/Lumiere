<?php

namespace App\Repositories\User;

use App\DataTransferObjects\Auth\RegisterDto;
use App\DataTransferObjects\User\AssignRoleDto;
use App\DataTransferObjects\User\UserDto;
use App\Models\User\User;

interface UserRepositoryInterface
{
    public function all(UserDto $dto): object;

    public function create(RegisterDto $dto): User;

    public function find(int $id): object;

    public function update(array $data, int $id): object;

    public function updatePassword(string $email, string $newPassword): object;

}
