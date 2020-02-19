<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['photo','name', 'description','unggulan','tampil'];
    public function order()
    {
        return $this->hasMany(Order::class);
    }
    public function Sub_Category()
    {
        return $this->hasMany(Sub_Category::class);
    }
public function Product()
    {
        return $this->hasMany(Product::class);
    }


    public function indukkategori()
    {
        return $this->belongsTo('App\indukkategori','induk_id');
    }

    
}
