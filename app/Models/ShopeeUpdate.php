<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShopeeUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'title',
        'content',
        'url',
        'update_time',
    ];
}
