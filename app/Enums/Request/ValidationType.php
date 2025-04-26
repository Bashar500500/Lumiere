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
    case Regex = 'regex';
    case Date = 'date';
    case DateFormat = 'date_format';
    case Image = 'image';
    case Decimal = 'decimal';
    case RequiredIf = 'required_if';
    case MissingIf = 'missing_if';

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
