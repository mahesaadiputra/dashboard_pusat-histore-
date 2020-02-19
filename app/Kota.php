<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    protected $guarded = [];
    protected $fillable = ['city_id', 'province_id','province','type','city_name','postal_code'];

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
    
    public function customer()
    {
        return $this->hasMany(Customer::class);
    }
}
