<?php

namespace App\Enums\Trait;

enum FunctionName: string
{
    case Index = 'index';
    case Show = 'show';
    case Store = 'store';
    case Update = 'update';
    case Delete = 'delete';
    case View = 'view';
    case Download = 'download';
    case Join = 'join';
    case Leave = 'leave';
    case Upload = 'upload';
    case Register = 'register';
    case Login = 'login';
    case Logout = 'logout';
    case SendCode = 'sendCode';
    case VerifyCode = 'verifyCode';
    case Assign = 'assign';
    case Revoke = 'revoke';

    public function getMessage(): string
    {
        $key = "Trait/functions.{$this->value}.message";
        $translation = __($key);

        if ($key == $translation)
        {
            return "Something went wrong";
        }

        return $translation;
    }
}
