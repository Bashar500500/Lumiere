<?php

namespace App\Models\Notification;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Notification extends Model
{
    protected $fillable = [
        'title',
        'body',
    ];

    public function notificationable(): MorphTo
    {
        return $this->morphTo();
    }
}
