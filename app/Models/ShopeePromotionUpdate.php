<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopeePromotionUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'promotion_id',
        'promotion_type',
        'action',
        'item_id',
        'variation_id',
        'start_time',
        'end_time',
    ];
}
