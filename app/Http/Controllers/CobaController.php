<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\stock_user_level;
use App\Product;

class CobaController extends Controller
{
    
    
     public function coba()
    {
        
      $panggil = stock_user_level::all();
      
      $panggil1 = json_encode($panggil);
      
      return response()->json([

            'data' => $panggil1
          ]);
        
        
    }
    
    public function update(Request $request)
    {
        
        $this->validate($request, [
            'qty' => 'required',
            
        ]);
        
      $panggil = stock_user_level::all();
      
      
      return response()->json([
            'state' => true,
            'data' => $panggil
          ]);
        
        
    }
    
    public function index($id)
    {$nama=auth()->user()->email;
        
       $products = 
              Product::select(
                  'products.id',
                  'code',
                  'name',
                  'products.price as price',
                  'stock_level.user_level1->'.$nama.' as stock',
                  'description',
                  'category_id',
                  'photo',
                  'created_at',
                  'updated_at')
                  ->join('stock_level','products.level_stock_id','=','stock_level.id')
                  ->find($id);
    
                  
                  
            if ($products) {
                return response()->json([
                    'state' => true,
                    'message' => 'succes get data',
                    'data' => $products
                ], 200);
            }
            return response()->json([
                'message' => 'failed get data',
                'data' => []
            ]);
    }
    
    
    
    
    

    
    
}
