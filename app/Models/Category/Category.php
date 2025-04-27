<?php

namespace App\Models\Category;

use App\Enums\Category\CategoryStatus;
use App\Models\Attachment\Attachment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'description',
    ];
    protected $casts = [
        'status' => CategoryStatus::class,
    ];

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }

    public function attachment(): MorphOne
    {
        return $this->morphOne(Attachment::class, 'attachmentable');
    }
}
