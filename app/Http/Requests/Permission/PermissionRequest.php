<?php

namespace App\Http\Requests\Permission;

use App\Enums\Auth\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class PermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function onIndex() {
        return [
            'page' => ['required', 'integer'],
            'page_size' => ['nullable', 'integer'],
        ];
    }
    protected function onStore() {
        return [
            'name' => 'required|string|unique:permissions,name',
            'guard_name' => 'nullable|string',
            'role' => ['required', new Enum(UserRole::class)],
        ];
    }

    protected function onUpdate() {
        return [
            'name' => 'required|string',
            'guard_name' => 'nullable|string',
            'role' => ['required', new Enum(UserRole::class)],
        ];
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if (request()->isMethod('get'))
        {
            return $this->onIndex();
        }
        else if (request()->isMethod('post'))
        {
            return $this->onStore();
        }
        else
        {
            return $this->onUpdate();
        }
    }
}
