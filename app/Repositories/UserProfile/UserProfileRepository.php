<?php

namespace App\Repositories\UserProfile;

use App\DataTransferObjects\UserProfile\UserProfileDto;
use App\Models\User\UserProfile;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class UserProfileRepository extends BaseRepository implements UserProfileRepositoryInterface
{

    public function __construct(UserProfile $user_profile)
    {
        parent::__construct($user_profile);
    }

    public function create(int $userId, UserProfileDto $dto): object
    {
        $user_profile = DB::transaction(function () use ($dto,$userId) {
            $user_profile = $this->model->create([
                'user_id' => $userId,
                'phone' => $dto->phone,
                'avatar' => $dto->avatar,
                'address' => $dto->address,
                'gender' => $dto->gender,
                'birthdate' => $dto->birthdate,
            ]);
            return $user_profile;
        });

        return (object) $user_profile;
    }

    public function update(int $userId, UserProfileDto $dto): object
    {
        $profile = UserProfile::where('user_id', $userId)->firstOrFail();
        $user_profile = DB::transaction(function () use ($dto,$userId, $profile) {
            $user_profile = tap($profile)->update([
                'user_id' => $userId,
                'phone' => $dto->phone,
                'avatar' => $dto->avatar,
                'address' => $dto->address,
                'gender' => $dto->gender,
                'birthdate' => $dto->birthdate,
            ]);
            return $user_profile;
        });

        return (object) $user_profile;
    }

    public function findByUserId(int $userId): ?UserProfile
    {
        return UserProfile::where('user_id', $userId)->first();
    }
}
