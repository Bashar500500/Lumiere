<?php

namespace App\Enums\User;

enum Gender: string
{
    case Male = 'male';
    case Female = 'female';

    public function getType(): string
    {
        return match ($this) {
            self::Male => 'male',
            self::Female => 'female',
        };
    }
}