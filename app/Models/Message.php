<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'sender_id',
        'message',
        'attachment',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship: The message belongs to a chat.
     */
    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    /**
     * Relationship: The message belongs to a sender (user).
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Check if the message has an attachment.
     */
    public function hasAttachment(): bool
    {
        return !is_null($this->attachment);
    }

    /**
     * Get the full URL for the attachment.
     */
    public function getAttachmentUrlAttribute(): ?string
    {
        return $this->attachment ? asset('storage/' . $this->attachment) : null;
    }

    /**
     * Get the attachment file extension.
     */
    public function getAttachmentExtensionAttribute(): ?string
    {
        return $this->attachment ? pathinfo($this->attachment, PATHINFO_EXTENSION) : null;
    }

    /**
     * Check if attachment is an image.
     */
    public function isImage(): bool
    {
        if (!$this->hasAttachment()) {
            return false;
        }

        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        return in_array(strtolower($this->attachmentExtension), $imageExtensions);
    }
}