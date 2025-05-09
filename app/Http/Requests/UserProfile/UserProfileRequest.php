<?php

namespace App\Http\Requests\UserProfile;

use App\Enums\User\Gender;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UserProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'phone' => 'nullable|string|min:10',
            'address' => 'nullable|string',
            'avatar' => 'nullable|string',
            'gender' => ['nullable',new Enum(Gender::class)],
            'birthdate' => 'nullable|date',
        ];
    }
}
