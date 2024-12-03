<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShopeeOrderStatusUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'ordersn',
        'shop_id',
        'status',
        'completed_scenario',
        'update_time',
    ];
}
