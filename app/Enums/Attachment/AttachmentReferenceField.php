<?php

namespace App\Enums\Attachment;

enum AttachmentReferenceField: string
{
    case CoverImage = 'cover_image';
    case SubCategoryImage = 'sub_category_image';
    case CategoryImage = 'category_image';
}
