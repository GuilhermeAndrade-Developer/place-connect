<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopeeWebhookLog extends Model
{
    protected $fillable = ['event_type', 'data'];

    protected $casts = [
        'data' => 'array',
    ];
}
