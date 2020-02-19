<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stock_level extends Model
{
    protected $fillable=[
        'stock','id','user_id','product_id'
        
        ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function product()
    {
        return $this->hasMany(Product::class);
    }
    
    public $timestamps = false;
    protected $table='stock_level';
    
}
