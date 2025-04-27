<?php

namespace App\Enums\Request;

enum FieldName: string
{
    case Type = 'type';
    case IssuerId = 'issuer_id';
    case ChatId = 'chat_id';
    case Page = 'page';
    case PageSize = 'page_size';
    case Message = 'message';
    case IsRead = 'is_read';
    case MessageId = 'message_id';
    case Reply = 'reply';
    case UserId = 'user_id';
    case Title = 'title';
    case Body = 'body';
    case Name = 'name';
    case Description = 'description';
    case CategoryId = 'category_id';
    case Language = 'language';
    case Level = 'level';
    case Timezone = 'timezone';
    case StartDate = 'start_date';
    case EndDate = 'end_date';
    case CoverImage = 'cover_image';
    case CategoryImage = 'category_image';
    case SubCategoryImage = 'sub_category_image';
    case Status = 'status';
    case Duration = 'duration';
    case Price = 'price';
    case AccessType = 'access_type';
    case PriceHidden = 'price_hidden';
    case IsSecret = 'is_secret';
    case EnrollmentLimitEnabled = 'enrollment_limit_enabled';
    case EnrollmentLimitLimit = 'enrollment_limit_limit';
    case PersonalizedLearningPaths = 'personalized_learning_paths';
    case CertificateRequiresSubmission = 'certificate_requires_submission';
    case AttachFiles = 'attach_files';
    case CreateTopics = 'create_topics';
    case EditReplies = 'edit_replies';
    case StudentGroups = 'student_groups';
    case IsFeatured = 'is_featured';
    case ShowProgressScreen = 'show_progress_screen';
    case HideGradeTotals = 'hide_grade_totals';

    public function getMessage(): string
    {
        $key = "Request/fields.{$this->value}.message";
        $translation = __($key);

        if ($key == $translation)
        {
            return "Something went wrong";
        }

        return $translation;
    }
}
