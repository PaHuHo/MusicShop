<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $table='product';
    public $primaryKey = 'product_id';
    protected $keyType = 'string';
    public $incrementing = false;
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

    public function category(){
        return $this->BelongsTo(CategoryProduct::class,'category_id','id');
    }
}
