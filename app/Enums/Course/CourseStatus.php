<?php

namespace App\Enums\Course;

enum CourseStatus: string
{
    case Published = 'published';
    case Unpublished = 'unpublished';

    public function getType(): string
    {
        return match ($this) {
            self::Published => 'published',
            self::Unpublished => 'unpublished',
        };
    }
}
