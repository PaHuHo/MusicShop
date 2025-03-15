<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Customer extends Authenticatable implements JWTSubject
{
    use HasFactory;
    public $primaryKey = 'customer_id';
    protected $casts = [
        'customer_id' => 'string',
    ];
    protected $table='customer';
    protected $fillable=[
        'customer_id',
        'name',
        'email',
        'phone_number',
        'password',
        'is_active'
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    // Trả về các claims bổ sung cho JWT
    public function getJWTCustomClaims()
    {
        return [];
    }
}
