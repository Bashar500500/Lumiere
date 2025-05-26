<?php

namespace App\Emails;

use App\Models\User\PasswordResetCode;
use Illuminate\Support\Facades\Mail;

class PasswordResetEmail
{
    public function sendEmail(PasswordResetCode $passwordResetCode): void
    {
        Mail::raw("Your password reset code is: $passwordResetCode->code", function ($message) use ($passwordResetCode) {
            $message->to($passwordResetCode->email)->subject('Password Reset Code');
        });
    }
}
