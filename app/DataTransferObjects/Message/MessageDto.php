<?php

namespace App\DataTransferObjects\Message;

use App\Http\Requests\Message\MessageRequest;

class MessageDto
{
    public function __construct(
        public readonly int $chatId,
        public readonly int $currentPage,
        public readonly int $pageSize,
        public readonly string $message,
    ) {}

    public static function fromIndexRequest(MessageRequest $request): MessageDto
    {
        return new self(
            chatId: $request->validated('chat_id'),
            currentPage: $request->validated('page'),
            pageSize: $request->validated('page_size') ?? 20,
            message: '',
        );
    }

    public static function fromStoreRequest(MessageRequest $request): MessageDto
    {
        return new self(
            chatId: $request->validated('chat_id'),
            currentPage: 0,
            pageSize: 0,
            message: $request->validated('message'),
        );
    }

    public static function fromUpdateRequest(MessageRequest $request): MessageDto
    {
        return new self(
            chatId: 0,
            currentPage: 0,
            pageSize: 0,
            message: $request->validated('message'),
        );
    }
}
