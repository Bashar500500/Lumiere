<?php

namespace App\Enums\Attachment;

enum AttachmentReferenceField: string
{
    case CourseCoverImage = 'cover_image';
    case GroupImageUrl = 'image_url';
    case LearningActivityPdfContentFile = 'learning_activity_pdf_content_file';
    case LearningActivityVideoContentFile = 'learning_activity_video_content_file';
    case SectionResourcesFile = 'section_resources_file';
    case SectionResourcesLink = 'section_resources_link';
    case CoverImage = 'cover_image';
    case SubCategoryImage = 'sub_category_image';
    case CategoryImage = 'category_image';
}
