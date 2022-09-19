<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=['product_id',
    'category_id',
    'name',
    'descriptin',
    'waiting_time',
    'image',
    'price',
    'view_count','waiting_time'];
}
