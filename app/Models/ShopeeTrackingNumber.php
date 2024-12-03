<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopeeTrackingNumber extends Model
{
    use HasFactory;

    protected $fillable = [
        'ordersn',
        'shop_id',
        'package_number',
        'tracking_no',
        'updated_at',
    ];
}
