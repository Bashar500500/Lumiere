<?php

namespace App\Enums\Category;

enum CategoryStatus: string
{
    case Active = 'Active';
    case Inactive = 'Inactive';

    public function getType(): string
    {
        return match ($this) {
            self::Active => 'Active',
            self::Inactive => 'Inactive',
        };
    }
}
