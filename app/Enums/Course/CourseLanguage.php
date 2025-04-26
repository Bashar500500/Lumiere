<?php

namespace App\Enums\Course;

enum CourseLanguage: string
{
    case English = 'English';
    case France = 'France';
    case Arabic = 'Arabic';

    public function getType(): string
    {
        return match ($this) {
            self::English => 'English',
            self::France => 'France',
            self::Arabic => 'Arabic',
        };
    }
}
