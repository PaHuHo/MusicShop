<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory;
    protected $table='users';
    protected $fillable=[
        'id',
        'name',
        'email',
        'is_active',
        'is_delete',
        'last_login_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

}
