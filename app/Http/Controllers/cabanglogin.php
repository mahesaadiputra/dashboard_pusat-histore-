<?php

namespace App\Http\Controllers;

use App\user_cabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Input;
use App\Product;
use App\Customer;
use App\Order;
use App\User;

class cabanglogin extends Controller
{
    public function logincabang(Request $request)
    {
        
        
$email = Input::get('email');
$password=Input::get('password');


    $user = user_cabang::where('email', '=', $email)->first();
    if (!$user) {
        return response()->json(['success'=>false, 
        
        'message' => 'password salah',
        'email'=>null,
         'status'=>0
        ]);
    }
    if (!Hash::check($password, $user->password)) {
        return response()->json(['success'=>false, 
          'message' => 'password salah',
        'email'=>null,
        'status'=>0
        ]);
        
    }
     $token = JWTAuth::fromUser($user);
    return response()->json(['success'=>true,'message'=>'success', 
    'status'=>$user->status,
    'email' => $user->email,
    'token' => $token
    ]);
    
    

  
}

public function product(){

  $product = Product::count();
            $order = Order::count();
            $customer = Customer::count();
            $user = User::count();
                $ordernotif = Order::where('status','0')->count();

                  $data_body['order'] = $order;
                $data_body['customer'] = $customer;
                 $data_body['user'] = $customer;
                 $data_body['product'] = $product;


                
                $response_client['state'] = true;
                $response_client['data'] = $data_body;
                $response_client['message'] = 'Data valid';
                
                return $response_client;



}
    


    public function productall(){

  $product = Product::select(

    'products.id',
    'products.name',
    'code',
    'price',
    'products.unggulan',
    'products.photo',
    'categories.name as kategori',




  )->join('categories','products.category_id','=','categories.id')
  ->where('products.tampil','ya')->get();
            

    return response()->json([ 
    'product' =>$product,
    ]);




}



}