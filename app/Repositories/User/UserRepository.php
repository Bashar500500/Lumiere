<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use App\Models\User\User;
use App\DataTransferObjects\Auth\RegisterDto;
use App\DataTransferObjects\User\AssignRoleDto;
use App\DataTransferObjects\User\UserDto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function all(UserDto $dto): object
    {
        return (object) $this->model
            ->simplePaginate(
                $dto->pageSize,
                ['*'],
                'page',
                $dto->currentPage,
            );
    }

    public function create(RegisterDto $dto): User
    {
        $user = DB::transaction(function () use ($dto) {
            $user = $this->model->create([
                'first_name' => $dto->first_name,
                'last_name' => $dto->last_name,
                'email' => $dto->email,
                'password' => Hash::make($dto->password),
                
            ]);
            $user['role'] = $user->assignRole($dto->role);
            return $user;
        });

        return $user;
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

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
    
    public function createFromSocial(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
        ]);
    }

    public function updatePassword(string $email, string $newPassword): object
    {
        $user = User::where('email', $email)->firstOrFail();
        $user->update(['password' => Hash::make($newPassword)]);
        return (object) $user;
    }
}
