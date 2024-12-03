<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopeeShippingDocumentStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'ordersn',
        'shop_id',
        'package_number',
        'status',
    ];
}