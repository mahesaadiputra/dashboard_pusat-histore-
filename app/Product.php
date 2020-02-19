<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use app\stock_kasir;

class Product extends Model
{
    protected $guarded = [];
    
    protected $fillable = [
    'product_stock_id','code','name','description','stock','price','photo','price_level4','price_level3','price_level2','price_level1','sub_cat_id','category_id','weight','lebar','tinggi','volume','unggulan',
    'photo_2','photo_3','tampil','harga_user','minimum_level_1','minimum_level_2','minimum_level_3','minimum_level_4','induk_id','itki','nama_umkm','alamat_umkm','barcode','histore'
    ];
    
    public function category()
    {
        return $this->belongsTo('App\Category','category_id');
    }
    public function order()
    {
        return $this->hasMany(Order::class);
    }
    
    public function Rating()
    {
        return $this->hasMany(Rating::class);
    }
    
    public function favorit()
    {
        return $this->hasMany(Favorit::class);
    }
    
     public function prodphoto()
    {
        return $this->hasMany(Prodphoto::class);
    }
    
    
    public function getFormattedPriceAttribute()
    {
        return number_format($this->attributes['price_level1'], 2);
    }
    
    public function stock_level()
    {
        return $this->belongsTo('App\stock_level','stock_level_id');
    }
    
    public function stock_kasir()
    {
        return $this->belongsTo('App\stock_kasir','product_stock_id');
    }
     public function stock_user_level()
    {
        return $this->belongsTo('App\stock_kasir','product_stock_id');
    }
     public function Sub_Category()
    {
        return $this->belongsTo('App\Sub_Category','sub_cat_id');
    }

     public function induk_kategori()
    {
        return $this->belongsTo('App\indukkategori','induk_id');
    }
    protected $primarykey='id';
}
