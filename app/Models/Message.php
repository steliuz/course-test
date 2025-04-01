<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model

{
    use HasFactory;
    protected $table = 'message';

    protected $fillable = ['title', 'content', 'created_at'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'message_user')
            ->using(MessageUser::class)
            ->withPivot('type', 'course_id', 'age', 'created_at', 'updated_at');
    }

    public static function getMessagesForUser($userId)
    {
        return self::query()
            ->whereHas('users', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->with('users')
            ->get();
    }
}
