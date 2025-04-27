<?php

namespace App\Enums\Trait;

enum FunctionName: string
{
    case Index = 'index';
    case Show = 'show';
    case Store = 'store';
    case Update = 'update';
    case Delete = 'delete';
    case Register = 'register';

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
