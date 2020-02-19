<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    protected $table = 'valid_otp';
    protected $fillable = ['status','otp','user_id'];
    
    
    
    public $timestamps=false;
}
