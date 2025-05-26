<?php
namespace App\DataTransferObjects\User;

use App\Http\Requests\Permission\PermissionRequest;
use App\Http\Requests\User\UserRequest;

class UserDto
{
    public function __construct(
        public readonly ?int $currentPage,
        public readonly ?int $pageSize,
        public readonly ?string $email,
        public readonly ?int $courseId,
        public readonly ?string $studentCode,
    ) {}

    public static function fromindexRequest(UserRequest $request): UserDto
    {
        return new self(
            currentPage: $request->validated('page'),
            pageSize: $request->validated('page_size'),
            email: null,
            courseId: null,
            studentCode: null,
        );
    }

    public static function fromAddStudentToCourseRequest(UserRequest $request): UserDto
    {
        return new self(
            currentPage: null,
            pageSize: null,
            email: $request->validated('email'),
            courseId: $request->validated('course_id'),
            studentCode: $request->validated('student_code'),
        );
    }
}
