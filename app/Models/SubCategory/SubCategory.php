<?php

namespace App\Models\SubCategory;

use App\Enums\Category\CategoryStatus;
use App\Models\Attachment\Attachment;
use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'category_id',
        'description',
    ];

    protected $casts = [
        'status' => CategoryStatus::class,
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
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
