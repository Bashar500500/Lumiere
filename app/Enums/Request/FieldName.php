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
    case InstructorId = 'instructor_id';
    case Name = 'name';
    case Description = 'description';
    case CategoryId = 'category_id';
    case Language = 'language';
    case Url = 'url';
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
    case AccessSettings = 'access_settings';
    case AccessType = 'access_type';
    case PriceHidden = 'price_hidden';
    case IsSecret = 'is_secret';
    case EnrollmentLimit = 'enrollment_limit';
    case Enabled = 'enabled';
    case Limit = 'limit';
    case Features = 'features';
    case PersonalizedLearningPaths = 'personalized_learning_paths';
    case CertificateRequiresSubmission = 'certificate_requires_submission';
    case DiscussionFeatures = 'discussion_features';
    case AttachFiles = 'attach_files';
    case CreateTopics = 'create_topics';
    case EditReplies = 'edit_replies';
    case StudentGroups = 'student_groups';
    case IsFeatured = 'is_featured';
    case ShowProgressScreen = 'show_progress_screen';
    case HideGradeTotals = 'hide_grade_totals';
    case CourseId = 'course_id';
    case Access = 'access';
    case ReleaseDate = 'release_date';
    case HasPrerequest = 'has_prerequest';
    case PrerequisiteSectionIds = 'prerequisite_section_ids';
    case IsPasswordProtected = 'is_password_protected';
    case Password = 'password';
    case Groups = 'groups';
    case Activities = 'activities';
    case Resources = 'resources';
    case Files = 'files';
    case Links = 'links';
    case Image = 'image';
    case Capacity = 'capacity';
    case Min = 'min';
    case Max = 'max';
    case Current = 'current';
    case SectionId = 'section_id';
    case Flags = 'flags';
    case IsFreePreview = 'is_free_preview';
    case IsCompulsory = 'is_compulsory';
    case RequiresEnrollment = 'requires_enrollment';
    case Content = 'content';
    case Data = 'data';
    case Pdf = 'pdf';
    case SizeMB = 'size_mb';
    case Pages = 'pages';
    case Watermark = 'watermark';
    case Video = 'video';
    case Captions = 'captions';
    case ThumbnailUrl = 'thumbnail_url';
    case Completion = 'completion';
    case MinDuration = 'min_duration';
    case PassingScore = 'passing_score';
    case Rules = 'rules';
    case Availability = 'availability';
    case Start = 'start';
    case End = 'end';
    case Discussion = 'discussion';
    case Moderated = 'moderated';
    case Metadata = 'metadata';
    case Difficulty = 'difficulty';
    case Keywords = 'keywords';
    case DzChunkIndex = 'dz_chunk_index';
    case DzTotalChunkCount = 'dz_total_chunk_count';

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
