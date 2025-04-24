<?php

namespace App\DataTransferObjects\Chat;

use App\Http\Requests\Chat\ChatRequest;
use App\Enums\Chat\ChatType;

class ChatDto
{
    public function __construct(
        public readonly ChatType $type,
        public readonly int $currentPage,
        public readonly int $pageSize,
        public readonly int $issuerId,
    ) {}

    public static function fromIndexRequest(ChatRequest $request): ChatDto
    {
        return new self(
            type: ChatType::from($request->validated('type')),
            currentPage: $request->validated('page'),
            pageSize: $request->validated('page_size') ?? 20,
            issuerId: 0,
        );
    }

    public static function fromStoreRequest(ChatRequest $request): ChatDto
    {
        return new self(
            type: ChatType::from($request->validated('type')),
            currentPage: 0,
            pageSize: 0,
            issuerId: $request->validated('issuer_id'),
        );
    }
}
