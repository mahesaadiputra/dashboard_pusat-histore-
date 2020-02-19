<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];
    protected $fillable = ['email', 'name','address','phone','users_id','panggilan_alamat','kota_id'];

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }
    
    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
