<?php

namespace App\Enums\Request;

enum ValidationType: string
{
    case Required = 'required';
    case Enum = 'enum';
    case Exists = 'exists';
    case Integer = 'integer';
    case String = 'string';
    case Boolean = 'boolean';

    public function getMessage(): string
    {
        $key = "Request/validations.{$this->value}.message";
        $translation = __($key);

        if ($key == $translation)
        {
            return "Something went wrong";
        }

        return $translation;
    }
}
