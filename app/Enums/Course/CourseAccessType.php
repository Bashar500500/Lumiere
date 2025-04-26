<?php

namespace App\Enums\Course;

enum CourseAccessType: string
{
    case Draft = 'Draft';
    case Free = 'Free';
    case Paid = 'Paid';
    case Private = 'Private';
    case ComingSoon = 'Coming soon';

    public function getType(): string
    {
        return match ($this) {
            self::Draft => 'Draft',
            self::Free => 'Free',
            self::Paid => 'Paid',
            self::Private => 'Private',
            self::ComingSoon => 'Coming soon',
        };
    }
}
