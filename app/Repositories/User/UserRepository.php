<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use App\Models\User\User;
use App\DataTransferObjects\Auth\RegisterDto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function create(RegisterDto $dto): object
    {
        $user = DB::transaction(function () use ($dto) {
            $user = (object) $this->model->create([
                'name' => $dto->name,
                'email' => $dto->email,
                'role' => $dto->role,
                'password' => Hash::make($dto->password),
            ]);

            return $user;
        });

        return (object) $user;
    }

    public function find(int $id): object
    {
        return (object) parent::find($id);
    }

    public function update(array $data, int $id): object
    {
        $user = (object) parent::find($id);

        DB::transaction(function () use ($user, $data) {
            $user->update($data);
        });

        return (object) $user;
    }
}