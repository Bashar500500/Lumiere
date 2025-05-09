<?php

namespace App\Services\Global\Mail;

use App\Mail\Email;

class EmailService
{
    public function __construct(
        protected Email $email,
    ) {}

    public function sendEmail($code,$email): void
    {
        $this->email->sendEmail($code, $email);
    }
}
