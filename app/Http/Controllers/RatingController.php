<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\Rating;

class RatingController extends Controller
{
    public function getrating(Request $request){
        
        $products = 
              Rating::select(
                  'product_id',
                  'products.name as name')
                  ->join('products','ratings.product_id','=','products.id')
                  ->where('product_id', $request->product_id)->first();
                  
        $detail = Rating::select(
                  'rating'
                  )->where('product_id', $request->product_id)->avg('rating');
                  
        $convert = number_format($detail, 0, '.', ',');          
        
        
        if ($convert) {
                return response()->json([
                    'state' => true,
                    'message' => 'succes get data', 
                    'hasil' =>[
                    'product_id' => $products,
                    'avg' => $convert]
                ], 200);
            }
            return response()->json([
                'message' => 'Product tidak memiliki rating',
            ]);
    }
    
    
    
}
