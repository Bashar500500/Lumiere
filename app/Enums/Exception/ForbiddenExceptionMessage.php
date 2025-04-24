<?php

namespace App\Enums\Exception;

enum ForbiddenExceptionMessage: string
{
    case Chat = 'chat';
    case Notification = 'notification';

    public function getDescription(): string
    {
        $key = "Exception/forbiddens.{$this->value}.description";
        $translation = __($key);

        if ($key == $translation)
        {
            return "Something went wrong";
        }

        return $translation;
    }
}
