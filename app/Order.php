<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\order;
class Order extends Model
{
    protected $guarded = [];
    protected $dates = ['created_at'];
    
    public function order_detail()
    {
        return $this->hasMany(Order_detail::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function anggota()
    {
        return $this->belongsTo('App\anggota','user_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function sub_category()
    {
        return $this->belongsTo(Sub_Category::class);
    }
    
    public function stock_kasir()
    {
        return $this->belongsTo(stock_kasir::class);
    }
    public static function getnotif(){
        
        
         $value= Order::orderBy('id','DSC')->where('status','0')->get();
          return  $value;
    }
   
    
  
    
}
