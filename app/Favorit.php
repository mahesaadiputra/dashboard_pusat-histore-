<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorit extends Model
{
    protected $guarded = [];
    protected $fillable = ['user_id', 'product_id'];

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
