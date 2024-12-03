<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopeeWebhookLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_code',
        'payload',
    ];
}
