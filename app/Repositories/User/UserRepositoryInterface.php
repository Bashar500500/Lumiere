<?php

namespace App\Repositories\User;

use App\DataTransferObjects\Auth\RegisterDto;

interface UserRepositoryInterface
{
    public function create(RegisterDto $dto): object;

    public function find(int $id): object;

    public function update(array $data, int $id): object;

    public function updatePassword(string $email, string $newPassword): object;
}
