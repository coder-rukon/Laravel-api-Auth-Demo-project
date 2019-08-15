<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ApiUser extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password','id','email_verified_at','phone','phone_verified_at','created_at','country','locale'
    ];
    public function getAuthIdentifier()
    {
        return $this->attributes['id'];
    }
    
}
