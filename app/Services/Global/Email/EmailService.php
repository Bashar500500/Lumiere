<?php

namespace App\Services\Global\Email;

use App\Emails\PasswordResetEmail;
use App\Models\User\PasswordResetCode;

class EmailService
{
    public function __construct(
        protected PasswordResetEmail $email,
    ) {}

    public function sendEmail(PasswordResetCode $passwordResetCode): void
    {
        $this->email->sendEmail($passwordResetCode);
    }
}
