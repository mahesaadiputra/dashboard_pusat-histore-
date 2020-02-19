<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class user_cabang extends Authenticatable implements JWTSubject
{
    protected $table="cabang_users";
    protected $fillable=['email','password','name','status','role','alamat'];
    protected $hidden = [
        'password', 
    ];
    public $timestamps=false;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    
    
    
}
