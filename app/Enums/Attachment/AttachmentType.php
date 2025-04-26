<?php

namespace App\Enums\Attachment;

enum AttachmentType: string
{
    case Image = 'image';

    public function getType(): string
    {
        return match ($this) {
            self::Image => 'image',
        };
    }
}
