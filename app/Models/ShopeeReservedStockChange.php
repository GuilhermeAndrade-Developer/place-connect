<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopeeReservedStockChange extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'item_id',
        'variation_id',
        'action',
        'ordersn',
        'promotion_type',
        'promotion_id',
        'old_value',
        'new_value',
        'update_time',
    ];
}
