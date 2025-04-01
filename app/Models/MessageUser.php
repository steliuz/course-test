<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class MessageUser extends Pivot
{
    protected $table = 'message_user';

    protected $fillable = [
        'message_id',
        'user_id',
        'type',
        'course_id',
        'age',
        'created_at',
        'updated_at',
    ];

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
