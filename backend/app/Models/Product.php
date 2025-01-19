<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $primaryKey = 'product_id';
    protected $table='product';
    protected $fillable=[
        'product_id',
        'name',
        'price',
        'quantity',
        'image',
        'discount',
        'description',
        'category_id',
        'is_sales',
    ];
}
