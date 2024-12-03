<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopeePromotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'item_id',
        'variation_id',
        'promotion_type',
        'promotion_id',
        'action',
        'update_time',
        'start_time',
        'end_time',
        'reserved_stock',
    ];
}
