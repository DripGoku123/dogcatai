<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'email',
        'password',
        'name',
        'lastname',
        'cookiesession',
        'birthday',
        'dynamicurl',
        'encrypt',
        'notificationsk',
        'notificationsp'
    ];
    protected $hidden = [
        'password',
        'cookiesession',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
?>