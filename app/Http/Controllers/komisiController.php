<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\komisi;
use App\User;
use App\Order;
use App\atur_profit;
use App\cair_komisi;
use Carbon\Carbon;
use App\jurnal;
use App\batas_cair;
use App\Order_detail;
use App\Product;
class komisiController extends Controller
{
    public function index(Request $request){
        
        
        if(!empty($request->id_akun)){
            
            
            $komisi=komisi::orderBy('created_at','ASC')->where('id_akun',$request->id_akun)->paginate(1000);
        
        return view('komisi.index',compact('komisi'));
            
            
        }
        
        
         if(!empty($request->nama)){
            
            
            $komisi=komisi::orderBy('created_at','ASC')->where('id_nama',$request->nama)->paginate(1000);
        
        return view('komisi.index',compact('komisi'));
            
            
        }
        
        $komisi=komisi::orderBy('created_at','ASC')->paginate(10);
        
        return view('komisi.index',compact('komisi'));
        
    }
    
    
    
    
    public function edit($id){
        
    $komisi=komisi::where('id',$id)->first();
    
    
    
    return view('komisi.edit', compact('komisi'));
        
    }
    
    
    
    
    public function profit($inv){
        
        $tampungjual=user::where('userid','tampungjual')->first();
        $order=Order::where('invoice',$inv)->first();
     $profit=atur_profit::where('nama_karir','cabang')->first();
       $profit_bintang_1=atur_profit::where('nama_karir','Bintang 1')->first();
     $profit_bintang_2=atur_profit::where('nama_karir','Bintang 2')->first();
       $profit_bintang_3=atur_profit::where('nama_karir','Bintang 3')->first();
       $profit_bintang_4=atur_profit::where('nama_karir','Bintang 4')->first();
     $komisicabang=komisi::where('id_nama',$order->nama_cabang)->first();
$user=User::where('userid',$order->nama_cabang)->first();
$user_bintang1=User::where('userid',$order->usrid_level1)->first();
$user_bintang2=User::where('userid',$order->usrid_level2)->first();
$user_bintang3=User::where('userid',$order->usrid_level3)->first();
$user_bintang4=User::where('userid',$order->usrid_level4)->first();
$user_histore=User::where('userid',$order->usrid_level1)->first();



        
        if($order->karir == "cabang" &&  !empty($order->nama_cabang) && empty($order->usrid_level1)&& empty($order->usrid_level2)&& empty($order->usrid_level3)&& empty($order->usrid_level4)){
            
            $komisi=komisi::create([
                
                'id_nama'=>$order->nama_cabang,
                'id_akun'=> $user->hp,
                'jumlah'=>($order->harga_jual*$profit->profit /100),
                
                
                
                
                
                
                ]);
                

              return response()->json([
                    'state' => true,
                    'message' => 'komisi di kirim dan siap di konfirmasi',
                ], 200);  
            
            
            
            
        }
        
        
        
        
        
        if($order->karir == "cabang" &&!empty($order->nama_cabang) && !empty($order->usrid_level1)&&!empty($order->usrid_level2)&&!empty($order->usrid_level3)&&!empty($order->usrid_level4)){
            
            $komisi=komisi::create([
                
                'id_nama'=>$order->nama_cabang,
                'id_akun'=> $user->hp,
                'jumlah'=>($order->harga_jual*$profit->profit /100),
                
                
                
                
                
                
                ]);
                
                 $komisi_histore1=komisi::create([
                
                'id_nama'=>$user_histore->name,
                'id_akun'=> $user_histore->hp,
                'jumlah'=>($order->harga_jual*$profit_bintang_1->profit /100),
                
                
                
                
                
                
                ]);
                
                  $komisi_histore2=komisi::create([
                
                'id_nama'=>$user_histore->name,
                'id_akun'=> $user_histore->hp,
                'jumlah'=>($order->harga_jual*$profit_bintang_2->profit /100),
                
                
                
                
                
                
                ]);
                
                 $komisi_histore3=komisi::create([
                
                'id_nama'=>$user_histore->name,
                'id_akun'=> $user_histore->hp,
                'jumlah'=>($order->harga_jual*$profit_bintang_3->profit /100),
                
                
                
                
                
                
                ]);
                 $komisi_histore4=komisi::create([
                
                'id_nama'=>$user_histore->name,
                'id_akun'=> $user_histore->hp,
                'jumlah'=>($order->harga_jual*$profit_bintang_4->profit /100),
                
                
                
                
                
                
                ]);
                
               
              return response()->json([
                    'state' => true,
                    'message' => 'komisi di kirim dan siap di konfirmasi',
                ], 200);  
            
            
            
            
        }
        
        
        
        
        
        
        
        
          if($order->karir == "Bintang 4" &&!empty($order->nama_cabang) && !empty($order->usrid_level1)&&!empty($order->usrid_level2)&&!empty($order->usrid_level3)){
            
         
                  komisi::create([
                
                
                
                  'id_nama'=>$order->usrid_level4,
                'id_akun'=> $user_bintang4->hp,
                'jumlah'=>($order->harga_jual*$profit_bintang_4->profit /100),
                
                
                
                
                ]);
                   return response()->json([
                    'state' => true,
                    'message' => 'komisi di kirim dan siap di konfirmasi',
                ], 200); 
                
                
                
                 $komisi_histore1=komisi::create([
                
                'id_nama'=>$user_histore->name,
                'id_akun'=> $user_histore->hp,
                'jumlah'=>($order->harga_jual*$profit_bintang_1->profit /100),
                
                
                
                
                
                
                ]);
                
                  $komisi_histore2=komisi::create([
                
                'id_nama'=>$user_histore->name,
                'id_akun'=> $user_histore->hp,
                'jumlah'=>($order->harga_jual*$profit_bintang_2->profit /100),
                
                
                
                
                
                
                ]);
                
                 $komisi_histore3=komisi::create([
                
                'id_nama'=>$user_histore->name,
                'id_akun'=> $user_histore->hp,
                'jumlah'=>($order->harga_jual*$profit_bintang_3->profit /100),
                
                
                
                
                
                
                ]);
               
                
               
              return response()->json([
                    'state' => true,
                    'message' => 'komisi di kirim dan siap di konfirmasi',
                ], 200);  
            
            
            
            
        }
        
        
         if($order->karir == "Bintang 3" && empty($order->nama_cabang) && !empty($order->usrid_level1)&&!empty($order->usrid_level2)){
            
         
                  komisi::create([
                
                
                
                  'id_nama'=>$order->usrid_level3,
                'id_akun'=> $user_bintang3->hp,
                'jumlah'=>($order->harga_jual*$profit_bintang_3->profit /100),
                
                
                
                
                ]);
                   
                
                 $komisi_histore1=komisi::create([
                
                'id_nama'=>$user_histore->name,
                'id_akun'=> $user_histore->hp,
                'jumlah'=>($order->harga_jual*$profit_bintang_1->profit /100),
                
                
                
                
                
                
                ]);
                
                  $komisi_histore2=komisi::create([
                
                'id_nama'=>$user_histore->name,
                'id_akun'=> $user_histore->hp,
                'jumlah'=>($order->harga_jual*$profit_bintang_2->profit /100),
                
                
                
                
                
                
                ]);
                
               
                
               
              return response()->json([
                    'state' => true,
                    'message' => 'komisi di kirim dan siap di konfirmasi ya',
                ], 200);  
            
            
            
            
        }
        
         if($order->karir == "Bintang 2" && empty($order->nama_cabang) && !empty($order->usrid_level1)){
            
         
                  komisi::create([
                
                
                
                  'id_nama'=>$order->usrid_level2,
                'id_akun'=> $user_bintang2->hp,
                'jumlah'=>($order->harga_jual*$profit_bintang_2->profit /100),
                
                
                
                
                ]);
                   
                
                 $komisi_histore1=komisi::create([
                
                'id_nama'=>$user_histore->name,
                'id_akun'=> $user_histore->hp,
                'jumlah'=>($order->harga_jual*$profit_bintang_1->profit /100),
                
                
                
                
                
                
                ]);
                
               
                
               
                
               
              return response()->json([
                    'state' => true,
                    'message' => 'komisi di kirim dan siap di konfirmasi ya',
                ], 200);  
            
            
            
            
        }
        
        
        
        
        
        
        
        
        
        
        
        if($order->karir =="Bintang 1" && empty($order->nama_cabang) ){
            
            komisi::create([
                
                
                
                  'id_nama'=>$order->usrid_level1,
                'id_akun'=> $user_bintang1->hp,
                'jumlah'=>($order->harga_jual*$profit_bintang_1->profit /100),
                
                
                
                
                ]);
                   return response()->json([
                    'state' => true,
                    'message' => 'komisi di kirim dan siap di konfirmasi',
                ], 200);  
            
            
            
            
        }
        
        
        if($order->karir =="Bintang 2" && empty($order->nama_cabang)&& empty($order->usrid_level1) ){
            
            komisi::create([
                
                
                
                  'id_nama'=>$order->usrid_level2,
                'id_akun'=> $user_bintang2->hp,
                'jumlah'=>($order->harga_jual*$profit_bintang_2->profit /100),
                
                
                
                
                ]);
                   return response()->json([
                    'state' => true,
                    'message' => 'komisi di kirim dan siap di konfirmasi',
                ], 200);  
            
            
            
            
        }
        
        
        
        
        
        
        if($order->karir == "Bintang 3" && empty($order->nama_cabang)   && empty($order->usrid_level1)  && empty($order->usrid_level2)){
            
           komisi::create([
                
                
                
                  'id_nama'=>$order->usrid_level3,
                'id_akun'=> $user_bintang3->hp,
                'jumlah'=>($order->harga_jual*$profit_bintang_3->profit /100),
                
                
                
                
                ]);
                   return response()->json([
                    'state' => true,
                    'message' => 'komisi di kirim dan siap di konfirmasi ya',
                ], 200);  
            
            
        }
        
        
           
        if($order->karir == "Bintang 4" && empty($order->nama_cabang)  && empty($order->usrid_level1)&& empty($order->usrid_level2)&& empty($order->usrid_level3) ){
            
           komisi::create([
                
                
                
                  'id_nama'=>$order->usrid_level4,
                'id_akun'=> $user_bintang4->hp,
                'jumlah'=>($order->harga_jual*$profit_bintang_4->profit /100),
                
                
                
                
                ]);
                   return response()->json([
                    'state' => true,
                    'message' => 'komisi di kirim dan siap di konfirmasi',
                ], 200);  
            
            
        }
        
        
else{
    
    
    
     return response()->json([
                'message' => 'failed get data',
            
            ],401);
}
        
        
      
        
        
        
        
        
        
        
    }
    
    
    
    
    
    
    
      public function penjualan($inv){
        
        $tampungjual=user::where('userid','tampungjual')->first();
        $order=Order::where('invoice',$inv)->first();
        $usercari=User::where('id',$order->user_id)->first();
        $orderdetail=Order_detail::where('order_id',$order->id)->first();
        $product=Product::where('id',$orderdetail->product_id)->first();
        
     $profit=atur_profit::where('nama_karir','cabang')->first();
       $profit_bintang_1=atur_profit::where('nama_karir','Bintang 1')->first();
     $profit_bintang_2=atur_profit::where('nama_karir','Bintang 2')->first();
       $profit_bintang_3=atur_profit::where('nama_karir','Bintang 3')->first();
       $profit_bintang_4=atur_profit::where('nama_karir','Bintang 4')->first();
     $komisicabang=komisi::where('id_nama',$order->nama_cabang)->first();
$user=User::where('userid',$order->nama_cabang)->first();
$user_bintang1=User::where('userid',$order->usrid_level1)->first();
$user_bintang2=User::where('userid',$order->usrid_level2)->first();
$user_bintang3=User::where('userid',$order->usrid_level3)->first();
$user_bintang4=User::where('userid',$order->usrid_level4)->first();
$user_histore=User::where('userid',$order->usrid_level1)->first();



        
        if($order->karir == "cabang" &&  !empty($order->nama_cabang) ){
           
                 
                $rand=rand(00000000,99999999);
            
                
                
                
                    
                $tampungjualuser =   jurnal::create(['id_akun'=> $tampungjual->hp,
                                    'id_nama'=>$tampungjual->name,
                                    'debet' =>0,
                                    'kredit'=> $order->harga_jual,
                                    'ref_jurnal'=> '#'.$rand,
                                    'no_inv' =>$inv,
                                    'keterangan'=>"pembelian ".$product->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                
                
                  $jurnal_beli_user=  jurnal::create(['id_akun'=> $usercari->hp,
                                    'id_nama'=>$usercari->name,
                                    'debet' =>$order->harga_jual,
                                    'kredit'=> 0,
                                    'ref_jurnal'=>$tampungjualuser->ref_jurnal,
                                    'no_inv' =>$inv,
                                    'keterangan'=>"pembelian ".$product->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                
                
                
                
                
                $jurnal_jual=  jurnal::create(['id_akun'=> $user->hp,
                                    'id_nama'=>$user->name,
                                    'debet' =>0,
                                    'kredit'=> $order->harga_jual,
                                    'ref_jurnal'=>$tampungjualuser->ref_jurnal,
                                    'no_inv' =>$inv,
                                    'keterangan'=>"penjualan ".$product->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                
                
                   $jurnal_jual_cabang_tampung=  jurnal::create(['id_akun'=> $tampungjual->hp,
                                    'id_nama'=>$tampungjual->name,
                                    'debet' =>$order->harga_jual,
                                    'kredit'=> 0,
                                    'ref_jurnal'=>$tampungjualuser->ref_jurnal,
                                    'no_inv' =>$inv,
                                    'keterangan'=>"penjualan ".$product->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                   
                
                
                
                
                
            

                
                
              

              return response()->json([
                    'state' => true,
                    'message' => 'jurnal di catat',
                ], 200);  
            
            
            
            
        }
        
        
        
        
        
        
        
        if($order->karir == "Bintang 4" &&  empty($order->nama_cabang) ){
           
                 
                $rand=rand(00000000,99999999);
            
                
                
                
                    
                $tampungjualuser =   jurnal::create(['id_akun'=> $tampungjual->hp,
                                    'id_nama'=>$tampungjual->name,
                                    'debet' =>0,
                                    'kredit'=> $order->harga_jual,
                                    'ref_jurnal'=> '#'.$rand,
                                    'no_inv' =>$inv,
                                    'keterangan'=>"pembelian ".$product->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                
                
                  $jurnal_beli_user=  jurnal::create(['id_akun'=> $usercari->hp,
                                    'id_nama'=>$usercari->name,
                                    'debet' =>$order->harga_jual,
                                    'kredit'=> 0,
                                    'ref_jurnal'=>$tampungjualuser->ref_jurnal,
                                    'no_inv' =>$inv,
                                    'keterangan'=>"pembelian ".$product->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                
                
                
                
                
                $jurnal_jual=  jurnal::create(['id_akun'=> $user_bintang4->hp,
                                    'id_nama'=>$user_bintang4->name,
                                    'debet' =>0,
                                    'kredit'=> $order->harga_jual,
                                    'ref_jurnal'=>$tampungjualuser->ref_jurnal,
                                    'no_inv' =>$inv,
                                    'keterangan'=>"penjualan ".$product->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                
                
                   $jurnal_jual_cabang_tampung=  jurnal::create(['id_akun'=> $tampungjual->hp,
                                    'id_nama'=>$tampungjual->name,
                                    'debet' =>$order->harga_jual,
                                    'kredit'=> 0,
                                    'ref_jurnal'=>$tampungjualuser->ref_jurnal,
                                    'no_inv' =>$inv,
                                    'keterangan'=>"penjualan ".$product->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                   
                
                
                
                
                
            

                
                
              

              return response()->json([
                    'state' => true,
                    'message' => 'jurnal di catat',
                ], 200);  
            
            
            
            
        }
        
        
        
        
        
          
        if($order->karir == "Bintang 1" &&  empty($order->nama_cabang) ){
           
                 
                $rand=rand(00000000,99999999);
            
                
                
                
                    
                $tampungjualuser =   jurnal::create(['id_akun'=> $tampungjual->hp,
                                    'id_nama'=>$tampungjual->name,
                                    'debet' =>0,
                                    'kredit'=> $order->harga_jual,
                                    'ref_jurnal'=> '#'.$rand,
                                    'no_inv' =>$inv,
                                    'keterangan'=>"pembelian ".$product->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                
                
                  $jurnal_beli_user=  jurnal::create(['id_akun'=> $usercari->hp,
                                    'id_nama'=>$usercari->name,
                                    'debet' =>$order->harga_jual,
                                    'kredit'=> 0,
                                    'ref_jurnal'=>$tampungjualuser->ref_jurnal,
                                    'no_inv' =>$inv,
                                    'keterangan'=>"pembelian ".$product->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                
                
                
                
                
                $jurnal_jual=  jurnal::create(['id_akun'=> $user_bintang1->hp,
                                    'id_nama'=>$user_bintang1->name,
                                    'debet' =>0,
                                    'kredit'=> $order->harga_jual,
                                    'ref_jurnal'=>$tampungjualuser->ref_jurnal,
                                    'no_inv' =>$inv,
                                    'keterangan'=>"penjualan ".$product->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                
                
                   $jurnal_jual_cabang_tampung=  jurnal::create(['id_akun'=> $tampungjual->hp,
                                    'id_nama'=>$tampungjual->name,
                                    'debet' =>$order->harga_jual,
                                    'kredit'=> 0,
                                    'ref_jurnal'=>$tampungjualuser->ref_jurnal,
                                    'no_inv' =>$inv,
                                    'keterangan'=>"penjualan ".$product->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                   
                
                
                
                
                
            

                
                
              

              return response()->json([
                    'state' => true,
                    'message' => 'jurnal di catat',
                ], 200);  
            
            
            
            
        }
        
        
        
        
        
        
        
        
        
        
        
         if($order->karir == "Bintang 2" &&  empty($order->nama_cabang) ){
           
                 
                $rand=rand(00000000,99999999);
            
                
                
                
                    
                $tampungjualuser =   jurnal::create(['id_akun'=> $tampungjual->hp,
                                    'id_nama'=>$tampungjual->name,
                                    'debet' =>0,
                                    'kredit'=> $order->harga_jual,
                                    'ref_jurnal'=> '#'.$rand,
                                    'no_inv' =>$inv,
                                    'keterangan'=>"pembelian ".$product->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                
                
                  $jurnal_beli_user=  jurnal::create(['id_akun'=> $usercari->hp,
                                    'id_nama'=>$usercari->name,
                                    'debet' =>$order->harga_jual,
                                    'kredit'=> 0,
                                    'ref_jurnal'=>$tampungjualuser->ref_jurnal,
                                    'no_inv' =>$inv,
                                    'keterangan'=>"pembelian ".$product->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                
                
                
                
                
                $jurnal_jual=  jurnal::create(['id_akun'=> $user_bintang2->hp,
                                    'id_nama'=>$user_bintang2->name,
                                    'debet' =>0,
                                    'kredit'=> $order->harga_jual,
                                    'ref_jurnal'=>$tampungjualuser->ref_jurnal,
                                    'no_inv' =>$inv,
                                    'keterangan'=>"penjualan ".$product->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                
                
                   $jurnal_jual_cabang_tampung=  jurnal::create(['id_akun'=> $tampungjual->hp,
                                    'id_nama'=>$tampungjual->name,
                                    'debet' =>$order->harga_jual,
                                    'kredit'=> 0,
                                    'ref_jurnal'=>$tampungjualuser->ref_jurnal,
                                    'no_inv' =>$inv,
                                    'keterangan'=>"penjualan ".$product->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                   
                
                
                
                
                
            

                
                
              

              return response()->json([
                    'state' => true,
                    'message' => 'jurnal di catat',
                ], 200);  
            
            
            
            
        }
        
        
        
        
         if($order->karir == "Bintang 3" &&  empty($order->nama_cabang) ){
           
                 
                $rand=rand(00000000,99999999);
            
                
                
                
                    
                $tampungjualuser =   jurnal::create(['id_akun'=> $tampungjual->hp,
                                    'id_nama'=>$tampungjual->name,
                                    'debet' =>0,
                                    'kredit'=> $order->harga_jual,
                                    'ref_jurnal'=> '#'.$rand,
                                    'no_inv' =>$inv,
                                    'keterangan'=>"pembelian ".$product->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                
                
                  $jurnal_beli_user=  jurnal::create(['id_akun'=> $usercari->hp,
                                    'id_nama'=>$usercari->name,
                                    'debet' =>$order->harga_jual,
                                    'kredit'=> 0,
                                    'ref_jurnal'=>$tampungjualuser->ref_jurnal,
                                    'no_inv' =>$inv,
                                    'keterangan'=>"pembelian ".$product->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                
                
                
                
                
                $jurnal_jual=  jurnal::create(['id_akun'=> $user_bintang3->hp,
                                    'id_nama'=>$user_bintang3->name,
                                    'debet' =>0,
                                    'kredit'=> $order->harga_jual,
                                    'ref_jurnal'=>$tampungjualuser->ref_jurnal,
                                    'no_inv' =>$inv,
                                    'keterangan'=>"penjualan ".$product->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                
                
                   $jurnal_jual_cabang_tampung=  jurnal::create(['id_akun'=> $tampungjual->hp,
                                    'id_nama'=>$tampungjual->name,
                                    'debet' =>$order->harga_jual,
                                    'kredit'=> 0,
                                    'ref_jurnal'=>$tampungjualuser->ref_jurnal,
                                    'no_inv' =>$inv,
                                    'keterangan'=>"penjualan ".$product->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                   
                
                
                
                
                
            

                
                
              

              return response()->json([
                    'state' => true,
                    'message' => 'jurnal di catat',
                ], 200);  
            
            
            
            
        }
         
      
        
else{
    
    
    
     return response()->json([
                'message' => 'failed get data',
            
            ],401);
}
        
        
      
        
        
        
        
        
        
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public function update(Request $request,$id){
        
        $user=User::where('hp',$request->idakun)->first();
        
          $this->validate($request, [
            'status'   => 'required',
          
        ]);
        
        
        
        $komisi=komisi::where('id',$id)->first();
        
        
        $komisi->update([
            'status'=>$request->status,

            
            
            
            ]);
            
            
            
            if($request->status == "terkirim"){
                
                $user=User::where('hp',$request->idakun)->first();
                $user->profit;
                $user->update([
                    
                    'profit'=>$request->id_jumlah+$user->profit,
                    
                    
                    ]);
                
                
                
                
                
            }
            
            
            
            
        
 return redirect(route('komisi'))
                ->with(['success' => '<strong>' . $komisi->id_nama . '</strong>komisi di kirim']);        
        
        
    }
    
    
    
    
    public function cairkomisi(Request $request){
        
         $user=User::where('hp',$request->id_akun)->first();
         $batas=batas_cair::where('nama_batas','batas cair')->first();
         $dt= Carbon::now()->toDateString();
        $komisi=cair_komisi::where('id_akun',$request->id_akun)->where('tanggal_masuk',$dt)->sum('jumlah_pencairan');
        
        if($request->cair <= $user->profit && $request->cair <= $batas->jumlah && $komisi < $batas->jumlah){
            
              $user=User::where('hp',$request->id_akun)->first();
        $saldoprofit=$user->profit;
       
        $update=$user->update(
            [
                
                
                
                'profit'=>$saldoprofit-$request->cair ,
            
            
            
                
                ]
            );
            
            
            cair_komisi::create([
                
                
                'id_akun'=>$user->hp,
                'id_nama'=>$user->name,
                'jumlah_pencairan'=>$request->cair,
                'tanggal_masuk'=> Carbon::now()->toDateString(),
            
            
            
            
            ]);
            
            
            
            
               return response()->json([
                    'state' => true,
                    'message' => 'komisi anda siap di proses admin',
                ], 200);  
        }
        
      
        
        
        else{
    
    
    
     return response()->json([
                'message' => 'pencairan tidak memenuhi syarat',
            
            ],401);
}
        
        
        
        
        
    }
    
    
    
    
    
    
    
    
}
