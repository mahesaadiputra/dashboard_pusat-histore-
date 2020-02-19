<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sub_Category;
use App\Category;
class Sub_Category extends Model
{
    protected $fillable = ['category_id','sub_nama','description'];
    protected $table='sub_categories';

public function Product()
    {
        return $this->hasMany(Product::class);
    }
    public function Order()
    {
        return $this->hasMany(Order::class);
    }
    
     public function Category()
    {
        return $this->belongsTo('App\Category','category_id');
    }
    public $timestamps = false;




public static function getcategory(){
    
    
    $value=Category::orderBy('name','ASC')->get();
    return $value;
    
}




public static function getsubcat($subcat=0){
    
    $value=Sub_Category::where('category_id',$subcat)->get();
    
    
    return $value;
    
    
    
    
    
}
}
