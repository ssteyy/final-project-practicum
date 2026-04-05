<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'sender_id',
        'receiver_id',
        'message',
        'message_type',
        'file_path',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Message type constants
     */
    const TYPE_TEXT = 'text';
    const TYPE_IMAGE = 'image';
    const TYPE_VIDEO = 'video';
    const TYPE_VOICE = 'voice';

    /**
     * Check if message is a media message
     */
    public function isMediaMessage(): bool
    {
        return in_array($this->message_type, [self::TYPE_IMAGE, self::TYPE_VIDEO, self::TYPE_VOICE]);
    }

    /**
     * Get the full URL for the media file
     */
    public function getMediaUrlAttribute(): ?string
    {
        if ($this->file_path) {
            return asset('storage/' . $this->file_path);
        }
        return null;
    }

    /**
     * Get the order that owns the message
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the sender of the message
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Get the receiver of the message
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
