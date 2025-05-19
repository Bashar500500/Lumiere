<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id',
        'phone',
        'avatar',
        'address',
        'gender',
        'birthdate',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
