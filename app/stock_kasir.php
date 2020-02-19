<?php

namespace App;
use app\product;
use Illuminate\Database\Eloquent\Model;

class stock_kasir extends Model
{
    
    protected $fillable=[
        'jumlah','id','jakarta','surabaya'
        
        ];
    public function product()
    {
        return $this->hasMany('App\stock_kasir');
        
    }
    public function order()
    {
        return $this->hasMany(Order::class);
        
    }
    
    protected $table='stock_kasirs';
    
    protected $primarykey ='id';
    public $timestamps = false;
    
}



