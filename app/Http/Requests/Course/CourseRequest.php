<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Enums\Course\CourseLanguage;
use App\Enums\Course\CourseLevel;
use App\Enums\Course\CourseStatus;
use App\Enums\Course\CourseAccessType;
use App\Enums\Request\ValidationType;
use App\Enums\Request\FieldName;

class CourseRequest extends FormRequest
{
    // public function authorize(): bool
    // {
    //     return false;
    // }

    protected function onIndex() {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'page' => ['required', 'integer'],
            'page_size' => ['nullable', 'integer'],
        ];
    }

    protected function onStore() {
        return [
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            // 'category_id' => ['required', 'exists:categories,id'],
            'category_id' => ['required', 'integer'],
            'language' => ['required', new Enum(CourseLanguage::class)],
            'level' => ['required', new Enum(CourseLevel::class)],
            'timezone' => ['required', 'regex:^(?:Z|[+-](?:2[0-3]|[01][0-9]):[0-5][0-9])$^'],
            'start_date' => ['required', 'date', 'date_format:Y-m-d'],
            'end_date' => ['required', 'date', 'date_format:Y-m-d'],
            'cover_image' => ['nullable', 'image'],
            'status' => ['required', new Enum(CourseStatus::class)],
            'duration' => ['required', 'integer'],
            'price' => ['required', 'decimal:0,2'],
            'access_type' => ['required', new Enum(CourseAccessType::class)],
            'price_hidden' => ['required', 'boolean'],
            'is_secret' => ['required', 'boolean'],
            'enrollment_limit_enabled' => ['required', 'boolean'],
            'enrollment_limit_limit' => ['required_if:enrollment_limit_enabled,==,true', 'missing_if:enrollment_limit_enabled,==,false', 'integer'],
            'personalized_learning_paths' => ['required', 'boolean'],
            'certificate_requires_submission' => ['required', 'boolean'],
            'attach_files' => ['required', 'boolean'],
            'create_topics' => ['required', 'boolean'],
            'edit_replies' => ['required', 'boolean'],
            'student_groups' => ['required', 'boolean'],
            'is_featured' => ['required', 'boolean'],
            'show_progress_screen' => ['required', 'boolean'],
            'hide_grade_totals' => ['required', 'boolean'],
        ];
    }

    protected function onUpdate() {
        return [
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            // 'category_id' => ['required', 'exists:categories,id'],
            'category_id' => ['required', 'integer'],
            'language' => ['required', new Enum(CourseLanguage::class)],
            'level' => ['required', new Enum(CourseLevel::class)],
            'timezone' => ['required', 'regex:^(?:Z|[+-](?:2[0-3]|[01][0-9]):[0-5][0-9])$^'],
            'start_date' => ['required', 'date', 'date_format:Y-m-d'],
            'end_date' => ['required', 'date', 'date_format:Y-m-d'],
            'cover_image' => ['nullable', 'image'],
            'status' => ['required', new Enum(CourseStatus::class)],
            'duration' => ['required', 'integer'],
            'price' => ['required', 'decimal:0,2'],
            'access_type' => ['required', new Enum(CourseAccessType::class)],
            'price_hidden' => ['required', 'boolean'],
            'is_secret' => ['required', 'boolean'],
            'enrollment_limit_enabled' => ['required', 'boolean'],
            'enrollment_limit_limit' => ['required_if:enrollment_limit_enabled,==,true', 'missing_if:enrollment_limit_enabled,==,false', 'integer'],
            'personalized_learning_paths' => ['required', 'boolean'],
            'certificate_requires_submission' => ['required', 'boolean'],
            'attach_files' => ['required', 'boolean'],
            'create_topics' => ['required', 'boolean'],
            'edit_replies' => ['required', 'boolean'],
            'student_groups' => ['required', 'boolean'],
            'is_featured' => ['required', 'boolean'],
            'show_progress_screen' => ['required', 'boolean'],
            'hide_grade_totals' => ['required', 'boolean'],
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
            // 'user_id.required' => (ValidationType::Required)->getMessage(),
            // 'user_id.exists' => (ValidationType::Exists)->getMessage(),
            // 'page.required' => (ValidationType::Required)->getMessage(),
            // 'page.integer' => (ValidationType::Integer)->getMessage(),
            // 'page_size.integer' => (ValidationType::Integer)->getMessage(),
            // 'name.required' => (ValidationType::Required)->getMessage(),
            // 'name.string' => (ValidationType::String)->getMessage(),
            // 'description.string' => (ValidationType::String)->getMessage(),
            // 'category_id.required' => (ValidationType::Required)->getMessage(),
            // 'category_id.exists' => (ValidationType::Exists)->getMessage(),
            // 'language.required' => (ValidationType::Required)->getMessage(),
            // 'language.Illuminate\Validation\Rules\Enum' => (ValidationType::Enum)->getMessage(),
            // 'level.required' => (ValidationType::Required)->getMessage(),
            // 'level.Illuminate\Validation\Rules\Enum' => (ValidationType::Enum)->getMessage(),
            // 'timezone.required' => (ValidationType::Required)->getMessage(),
            // 'timezone.regex' => (ValidationType::Regex)->getMessage(),
            // 'start_date.required' => (ValidationType::Required)->getMessage(),
            // 'start_date.date' => (ValidationType::Date)->getMessage(),
            // 'start_date.date_format' => (ValidationType::DateFormat)->getMessage(),
            // 'end_date.required' => (ValidationType::Required)->getMessage(),
            // 'end_date.date' => (ValidationType::Date)->getMessage(),
            // 'end_date.date_format' => (ValidationType::DateFormat)->getMessage(),
            // 'cover_image.image' => (ValidationType::Image)->getMessage(),
            // 'status.required' => (ValidationType::Required)->getMessage(),
            // 'status.Illuminate\Validation\Rules\Enum' => (ValidationType::Enum)->getMessage(),
            // 'duration.required' => (ValidationType::Required)->getMessage(),
            // 'duration.integer' => (ValidationType::Integer)->getMessage(),
            // 'price.required' => (ValidationType::Required)->getMessage(),
            // 'price.decimal' => (ValidationType::Decimal)->getMessage(),
            // 'access_type.required' => (ValidationType::Required)->getMessage(),
            // 'access_type.Illuminate\Validation\Rules\Enum' => (ValidationType::Enum)->getMessage(),
            // 'price_hidden.required' => (ValidationType::Required)->getMessage(),
            // 'price_hidden.boolean' => (ValidationType::Boolean)->getMessage(),
            // 'is_secret.required' => (ValidationType::Required)->getMessage(),
            // 'is_secret.boolean' => (ValidationType::Boolean)->getMessage(),
            // 'enrollment_limit_enabled.required' => (ValidationType::Required)->getMessage(),
            // 'enrollment_limit_enabled.boolean' => (ValidationType::Boolean)->getMessage(),
            // 'enrollment_limit_limit.required_if' => (ValidationType::RequiredIf)->getMessage(),
            // 'enrollment_limit_limit.missing_if' => (ValidationType::MissingIf)->getMessage(),
            // 'enrollment_limit_limit.integer' => (ValidationType::Integer)->getMessage(),
            // 'personalized_learning_paths.required' => (ValidationType::Required)->getMessage(),
            // 'personalized_learning_paths.boolean' => (ValidationType::Boolean)->getMessage(),
            // 'certificate_requires_submission.required' => (ValidationType::Required)->getMessage(),
            // 'certificate_requires_submission.boolean' => (ValidationType::Boolean)->getMessage(),
            // 'attach_files.required' => (ValidationType::Required)->getMessage(),
            // 'attach_files.boolean' => (ValidationType::Boolean)->getMessage(),
            // 'create_topics.required' => (ValidationType::Required)->getMessage(),
            // 'create_topics.boolean' => (ValidationType::Boolean)->getMessage(),
            // 'edit_replies.required' => (ValidationType::Required)->getMessage(),
            // 'edit_replies.boolean' => (ValidationType::Boolean)->getMessage(),
            // 'student_groups.required' => (ValidationType::Required)->getMessage(),
            // 'student_groups.boolean' => (ValidationType::Boolean)->getMessage(),
            // 'is_featured.required' => (ValidationType::Required)->getMessage(),
            // 'is_featured.boolean' => (ValidationType::Boolean)->getMessage(),
            // 'show_progress_screen.required' => (ValidationType::Required)->getMessage(),
            // 'show_progress_screen.boolean' => (ValidationType::Boolean)->getMessage(),
            // 'hide_grade_totals.required' => (ValidationType::Required)->getMessage(),
            // 'hide_grade_totals.boolean' => (ValidationType::Boolean)->getMessage(),
        ];
    }

    public function attributes(): array
    {
        return [
            'user_id' => (FieldName::UserId)->getMessage(),
            'page' => (FieldName::Page)->getMessage(),
            'page_size' => (FieldName::PageSize)->getMessage(),
            'name' => (FieldName::Name)->getMessage(),
            'description' => (FieldName::Description)->getMessage(),
            'category_id' => (FieldName::CategoryId)->getMessage(),
            'language' => (FieldName::Language)->getMessage(),
            'level' => (FieldName::Level)->getMessage(),
            'timezone' => (FieldName::Timezone)->getMessage(),
            'start_date' => (FieldName::StartDate)->getMessage(),
            'end_date' => (FieldName::EndDate)->getMessage(),
            'cover_image' => (FieldName::CoverImage)->getMessage(),
            'status' => (FieldName::Status)->getMessage(),
            'duration' => (FieldName::Duration)->getMessage(),
            'price' => (FieldName::Price)->getMessage(),
            'access_type' => (FieldName::AccessType)->getMessage(),
            'price_hidden' => (FieldName::PriceHidden)->getMessage(),
            'is_secret' => (FieldName::IsSecret)->getMessage(),
            'enrollment_limit_enabled' => (FieldName::EnrollmentLimitEnabled)->getMessage(),
            'enrollment_limit_limit' => (FieldName::EnrollmentLimitLimit)->getMessage(),
            'personalized_learning_paths' => (FieldName::PersonalizedLearningPaths)->getMessage(),
            'certificate_requires_submission' => (FieldName::CertificateRequiresSubmission)->getMessage(),
            'attach_files' => (FieldName::AttachFiles)->getMessage(),
            'create_topics' => (FieldName::CreateTopics)->getMessage(),
            'edit_replies' => (FieldName::EditReplies)->getMessage(),
            'student_groups' => (FieldName::StudentGroups)->getMessage(),
            'is_featured' => (FieldName::IsFeatured)->getMessage(),
            'show_progress_screen' => (FieldName::ShowProgressScreen)->getMessage(),
            'hide_grade_totals' => (FieldName::HideGradeTotals)->getMessage(),
        ];
    }
}
