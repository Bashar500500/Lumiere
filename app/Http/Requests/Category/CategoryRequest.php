<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Enums\Category\CategoryStatus;
use App\Enums\Request\FieldName;
use App\Enums\Request\ValidationType;

class CategoryRequest extends FormRequest
{
    // public function authorize(): bool
    // {
    //     return false;
    // }

    protected function onIndex() {
        return [
            'page' => ['required', 'integer'],
            'page_size' => ['nullable', 'integer'],
        ];
    }

    protected function onStore() {
        return [
            'name' => ['required', 'string'],
            'status' => ['required', new Enum(CategoryStatus::class)],
            'description' => ['required', 'string'],
            'category_image' => ['nullable', 'image'],
        ];
    }

    protected function onUpdate() {
        return [
            'name' => ['required', 'string'],
            'status' => ['required', new Enum(CategoryStatus::class)],
            'description' => ['required', 'string'],
            'category_image' => ['nullable', 'image'],
        ];
    }

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

    public function messages(): array
    {
        return [
            'page.required' => (ValidationType::Required)->getMessage(),
            'page.integer' => (ValidationType::Integer)->getMessage(),
            'page_size.integer' => (ValidationType::Integer)->getMessage(),
            'name.required' => (ValidationType::Required)->getMessage(),
            'name.Illuminate\Validation\Rules\Enum' => (ValidationType::Enum)->getMessage(),
            'status.required' => (ValidationType::Required)->getMessage(),
            'status.string' => (ValidationType::String)->getMessage(),
            'description.required' => (ValidationType::Required)->getMessage(),
            'description.string' => (ValidationType::String)->getMessage(),
            'category_image.image' => (ValidationType::Image)->getMessage(),
        ];
    }

    public function attributes(): array
    {
        return [
            'page' => (FieldName::Page)->getMessage(),
            'page_size' => (FieldName::PageSize)->getMessage(),
            'name' => (FieldName::Name)->getMessage(),
            'status' => (FieldName::Status)->getMessage(),
            'description' => (FieldName::Description)->getMessage(),
            'category_image' => (FieldName::CategoryImage)->getMessage(),
        ];
    }
}
