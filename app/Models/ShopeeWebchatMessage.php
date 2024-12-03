<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopeeWebchatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'conversation_id',
        'message_id',
        'from_id',
        'from_user_name',
        'to_id',
        'to_user_name',
        'message_type',
        'content',
        'region',
        'is_in_chatbot_session',
        'created_timestamp',
    ];

    protected $casts = [
        'content' => 'array',
        'is_in_chatbot_session' => 'boolean',
    ];
}
