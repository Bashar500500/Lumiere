<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use App\Models\User\User;
use App\DataTransferObjects\Auth\RegisterDto;
use App\DataTransferObjects\User\AssignRoleDto;
use App\DataTransferObjects\User\UserDto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Enums\Auth\UserRole;
use App\Models\UserCourseGroup\UserCourseGroup;
use Carbon\Carbon;
use App\Enums\Trait\ModelName;
use App\Exceptions\CustomException;
use App\Enums\Exception\ForbiddenExceptionMessage;
use App\Enums\User\UserMessage;

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

    public function addStudentToCourse(UserDto $dto): UserMessage
    {
        $student = User::where('email', $dto->email)->first();

        if (! $student)
        {
            DB::transaction(function () use ($dto) {
                $student = $this->model->create([
                    'first_name' => 'New student',
                    'last_name' => 'NST',
                    'email' => $dto->email,
                    'password' => Hash::make('12345'),
                ]);
                $student['role'] = $student->assignRole(UserRole::from('student'));

                $orderNumber = UserCourseGroup::getOrder($dto->courseId);
                $order = str_pad($orderNumber, 3, "0", STR_PAD_LEFT);
                $year = Carbon::now()->format('Y');
                $studentCode = $dto->studentCode . $year . $order;

                $student->userCourseGroups()->create([
                    'course_id' => $dto->courseId,
                    'student_code' => $studentCode,
                ]);
            });

            return UserMessage::StudentCreatedAccountAndAddedToCourse;
        }

        $exists = $student->userCourseGroups->where('student_id', $student->id)
            ->where('course_id', $dto->courseId)->first();

        if ($exists)
        {
            throw CustomException::forbidden(ModelName::User, ForbiddenExceptionMessage::User);
        }

        DB::transaction(function () use ($dto, $student) {
                $orderNumber = UserCourseGroup::getOrder($dto->courseId);
                $order = str_pad($orderNumber, 3, "0", STR_PAD_LEFT);
                $year = Carbon::now()->format('Y');
                $studentCode = $dto->studentCode . $year . $order;

                $student->userCourseGroups()->create([
                    'course_id' => $dto->courseId,
                    'student_code' => $studentCode,
                ]);
        });

        return UserMessage::StudentAddedToCourse;
    }
}
