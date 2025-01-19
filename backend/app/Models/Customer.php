<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    public $primaryKey = 'customer_id';
    protected $table='customer';
    protected $fillable=[
        'customer_id',
        'name',
        'email',
        'phone_number',
        'password',
        'is_active'
    ];
}
