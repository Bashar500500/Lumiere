<?php

namespace App\Enums\Request;

enum FieldName: string
{
    case Type = 'type';
    case IssuerId = 'issuer_id';
    case ChatId = 'chat_id';
    case Page = 'page';
    case PageSize = 'page_size';
    case Message = 'message';
    case IsRead = 'is_read';
    case MessageId = 'message_id';
    case Reply = 'reply';
    case UserId = 'user_id';
    case Title = 'title';
    case Body = 'body';

    public function getMessage(): string
    {
        $key = "Request/fields.{$this->value}.message";
        $translation = __($key);

        if ($key == $translation)
        {
            return "Something went wrong";
        }

        return $translation;
    }
}
