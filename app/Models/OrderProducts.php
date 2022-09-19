<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'user_id',
        'qty',
        'total',
        'order_code'
    ];
}
