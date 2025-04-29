<?php

namespace App\DataTransferObjects\SubCategory;

use App\Enums\Category\CategoryStatus;
use App\Http\Requests\SubCategory\SubCategoryRequest;
use GuzzleHttp\Psr7\UploadedFile;

class SubCategoryDto
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly ?string $name,
        public readonly ?CategoryStatus $status,
        public readonly ?string $description,
        public readonly ?int $categoryId,
        public readonly ?UploadedFile $SubCategoryImage,
        public readonly ?int $currentPage,
        public readonly ?int $pageSize,
       
    ) {}

    public static function fromIndexRequest(SubCategoryRequest $request): SubCategoryDto
    {
        return new self(
            name: null,
            description: null,
            categoryId: null,
            status: null,
            SubCategoryImage: null,
            currentPage: $request->validated('page'),
            pageSize: $request->validated('page_size') ?? 20,
        );
    }

    public static function fromStoreRequest(SubCategoryRequest $request): SubCategoryDto
    {
        return new self(
            name: $request->validated('name'),
            status: CategoryStatus::from($request->validated('status')),
            description: $request->validated('description'),
            categoryId: $request->validated('category_id'),
            SubCategoryImage: null,
            currentPage: null,
            pageSize: null,
            
        );
    }
    public static function fromUpdateRequest(SubCategoryRequest $request): SubCategoryDto
    {
        return new self(
            name: $request->validated('name'),
            status: CategoryStatus::from($request->validated('status')),
            description: $request->validated('description'),
            categoryId: $request->validated('category_id'),
            SubCategoryImage: null,
            currentPage: null,
            pageSize: null,
        );
    }
}
