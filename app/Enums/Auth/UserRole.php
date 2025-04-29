<?php

namespace App\Enums\Auth;

enum UserRole: string
{
    case Admin = 'admin';
    case Student = 'student';
    case Instructor = 'instructor';

    public function getType(): string
    {
        return match ($this) {
            self::Admin => 'admin',
            self::Student => 'student',
            self::Instructor => 'instructor',
        };
    }
}