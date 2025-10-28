<?php

namespace App\Models;

use App\Models\User;
use App\Models\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'type',
        'name',
        'description',
    ];

    /**
     * Relationship: A chat can have many users (private or group).
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'chat_users')
                    ->withPivot('last_message_id')
                    ->withTimestamps();
    }

    /**
     * Relationship: A chat can have many messages.
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Optional helper: Get the latest message in a chat.
     */
    public function latestMessage()
    {
        return $this->hasOne(Message::class)->latestOfMany();
    }
}
