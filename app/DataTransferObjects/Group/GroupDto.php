<?php

namespace App\DataTransferObjects\Group;

use App\Http\Requests\Group\GroupRequest;
use Illuminate\Http\UploadedFile;

class GroupDto
{
    public function __construct(
        public readonly ?int $courseId,
        public readonly ?int $currentPage,
        public readonly ?int $pageSize,
        public readonly ?string $name,
        public readonly ?string $description,
        public readonly ?UploadedFile $image,
        public readonly ?GroupCapacityDto $groupCapacityDto,
    ) {}

    public static function fromIndexRequest(GroupRequest $request): GroupDto
    {
        return new self(
            courseId: $request->validated('course_id'),
            currentPage: $request->validated('page'),
            pageSize: $request->validated('page_size') ?? 20,
            name: null,
            description: null,
            image: null,
            groupCapacityDto: null,
        );
    }

    public static function fromStoreRequest(GroupRequest $request): GroupDto
    {
        return new self(
            courseId: $request->validated('course_id'),
            currentPage: null,
            pageSize: null,
            name: $request->validated('name'),
            description: $request->validated('description'),
            image: $request->validated('image') ?
                UploadedFile::createFromBase($request->validated('image')) :
                null,
            groupCapacityDto: GroupCapacityDto::from($request),
        );
    }

    public static function fromUpdateRequest(GroupRequest $request): GroupDto
    {
        return new self(
            courseId: null,
            currentPage: null,
            pageSize: null,
            name: $request->validated('name'),
            description: $request->validated('description'),
            image: $request->validated('image') ?
                UploadedFile::createFromBase($request->validated('image')) :
                null,
            groupCapacityDto: GroupCapacityDto::from($request),
        );
    }
}
