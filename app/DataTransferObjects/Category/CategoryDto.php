<?php

namespace App\DataTransferObjects\Category;

use App\Enums\Category\CategoryStatus;
use App\Http\Requests\Category\CategoryRequest;
use Illuminate\Http\UploadedFile;

class CategoryDto
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly ?string $name,
        public readonly ?CategoryStatus $status,
        public readonly ?string $description,
        public readonly ?UploadedFile $categoryImage,
        public readonly ?int $currentPage,
        public readonly ?int $pageSize,
       
    ) {}

    public static function fromIndexRequest(CategoryRequest $request): CategoryDto
    {
        return new self(
            name: null,
            description: null,
            status: null,
            categoryImage: null,
            currentPage: $request->validated('page'),
            pageSize: $request->validated('page_size') ?? 20,
        );
    }

    public static function fromStoreRequest(CategoryRequest $request): CategoryDto
    {
        return new self(
            name: $request->validated('name'),
            status: CategoryStatus::from($request->validated('status')),
            description: $request->validated('description'),
            categoryImage: null,
            currentPage: null,
            pageSize: null,
            
        );
    }
    public static function fromUpdateRequest(CategoryRequest $request): CategoryDto
    {
        return new self(
            name: $request->validated('name'),
            status: CategoryStatus::from($request->validated('status')),
            description: $request->validated('description'),
            categoryImage: null,
            currentPage: null,
            pageSize: null,
        );
    }
}
