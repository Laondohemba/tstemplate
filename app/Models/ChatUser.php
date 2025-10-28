<?php

namespace App\Models;

use App\Models\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChatUser extends Model
{
    use HasFactory;

    protected $table = 'chat_users'; // Explicitly define table name

    protected $fillable = [
        'chat_id',
        'user_id',
        'last_message_id',
    ];

    /**
     * Relationship: Each record belongs to a specific chat.
     */
    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    /**
     * Relationship: Each record belongs to a specific user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: References the last message read or sent.
     */
    public function lastMessage()
    {
        return $this->belongsTo(Message::class, 'last_message_id');
    }
}
