<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\jurnal;

class jurnalController extends Controller
{
    public function index(){
        
        $jurnal=jurnal::orderBy('created_at','DESC')->paginate(10);
        
        return view('jurnal.index',compact('jurnal'));
        
        
        
    }
    
    
    
     public function updatestatus(Request $request, $id)
    {
       
            $order = Order::findOrFail($id);
 
 
 
           
            if($order->invoice == $request->invoice && $request->status==3){
                
                
                 $order->update([
                
                'status' => $request->status,
            ]);
                $order=order::where('invoice',$request->invoice)->first();
                $order_detail=Order_detail::where('order_id',$id)->first();
                $product=Product::where('id',$order_detail->product_id)->first();
                $no_hp1=User::where('userid',$order->usrid_level1)->first();
                 $no_hp2=User::where('userid',$order->usrid_level2)->first();
                $no_hp3=User::where('userid',$order->usrid_level3)->first();
                 $no_hp4=User::where('userid',$order->usrid_level4)->first();
                $no_hp_intek=User::where('userid','intek')->first();
                 $no_hp_sellhbm=User::where('userid','sellshbm')->first();
                  $no_hp_penjualan=User::where('userid','penjualan')->first();
                    $no_hp_komisi=User::where('userid','pendapatankomisi')->first();
                    $bebanongkirhp=User::where('userid','bebanongkir')->first();
                       $tampungongkir=User::where('userid','penampunganongkir')->first();
                    $bebanvocher=User::where('userid','bebanvoucher')->first();
                     $tampungvoucher=User::where('userid','penampunganvoucher')->first();
                     
                     
                     
                    $jurnal_sellhbm=jurnal::create([
                    
                    'id_akun' =>$no_hp_sellhbm->hp,
                    'id_nama'=>$no_hp_sellhbm->name,
                    'keterangan'=>"pembelian ".$product->name,
                    'debet'=>$order->harga_jual-(50/100*$order->harga_jual+1500),
                    'kredit'=>"0",
                    'ref_jurnal'=>$order->invoice,
                    
                    
                    ]);
                 
                    if(!empty($order->usrid_level1)){
                        
                        
                $jurnal=jurnal::create([
                    
                    'id_akun' =>$no_hp1->hp,
                    'id_nama'=>$no_hp1->name,
                    'keterangan'=>"pemebelian ".$product->name,
                    'debet'=>$order->harga_jual*5/100,
                    'kredit'=>"0",
                    'ref_jurnal'=>$order->invoice,
                    
                    
                    ]);
                        
                        
                        
                         $komisi=komisi::where('id_nama',$no_hp1->name)->first();
                         if(!$komisi){
                          $komisi1=komisi::create([
                        
                        
                    'id-akun'=>$no_hp1->hp,
                    'id_nama'=>$no_hp1->name,
                    'jumlah'=>$order->harga_jual*5/100,
                    
                    
                    ]);
                    }
                    elseif($komisi){
                        
                        $jumlah=$komisi->jumlah;
                        $komisi->update([
                            'jumlah'=>$jumlah+$order->harga_jual*5/100,
                            'jumlah_sebelumnya'=>$jumlah,
                            
                            
                            ]);
                        
                        
                        
                        
                    }
                        
                        
                        
                        
                        
                        
                    }
                    if(!empty($order->usrid_level2)){
                    $jurnal2=jurnal::create([
                    
                    
                    
                    
                    'id_akun' =>$no_hp2->hp,
                    'id_nama'=>$no_hp2->name,
                    'keterangan'=>"pemebelian ".$product->name,
                    'debet'=>$order->harga_jual*10/100,
                    'kredit'=>"0",
                    'ref_jurnal'=>$order->invoice,
                    
                    
                    ]);
                    
                    $komisi=komisi::where('id_nama',$no_hp2->name)->first();
                         if(!$komisi){
                          $komisi1=komisi::create([
                        
                        
                    'id-akun'=>$no_hp2->hp,
                    'id_nama'=>$no_hp2->name,
                    'jumlah'=>$order->harga_jual*10/100,
                    
                    
                    ]);
                    }
                    elseif($komisi){
                        
                        $jumlah=$komisi->jumlah;
                        $komisi->update([
                            'jumlah'=>$jumlah+$order->harga_jual*10/100,
                            'jumlah_sebelumnya'=>$jumlah,
                            
                            
                            ]);
                        
                        
                        
                        
                    }
                    
                    
                    
                    }
                    if(!empty($order->usrid_level3)){
                      $jurnal3=jurnal::create([
                     
                    'id_akun' =>$no_hp3->hp,
                       'id_nama'=>$no_hp3->name,
                    'keterangan'=>"pemebelian ".$product->name,
                    'debet'=>$order->harga_jual*15/100,
                    'kredit'=>"0",
                    'ref_jurnal'=>$order->invoice,
                    
                    
                    ]);
                        
                        
                        
                        
                                            
                    $komisi=komisi::where('id_nama',$no_hp3->name)->first();
                         if(!$komisi){
                          $komisi1=komisi::create([
                        
                        
                    'id-akun'=>$no_hp3->hp,
                    'id_nama'=>$no_hp3->name,
                    'jumlah'=>$order->harga_jual*15/100,
                    
                    
                    ]);
                    }
                    elseif($komisi){
                        
                        $jumlah=$komisi->jumlah;
                        $komisi->update([
                            'jumlah'=>$jumlah+$order->harga_jual*15/100,
                            'jumlah_sebelumnya'=>$jumlah,
                            
                            
                            ]);
                    }
                    
                     if(!empty($order->usrid_level4)){
                      $jurnal4=jurnal::create([
                     
                    'id_akun' =>$no_hp4->hp,
                     'id_nama'=>$no_hp4->name,
                    'keterangan'=>"pemebelian ".$product->name,
                    'debet'=>$order->harga_jual*20/100,
                    'kredit'=>"0",
                    'ref_jurnal'=>$order->invoice,
                    
                    
                    ]);
                         $komisi=komisi::where('id_nama',$no_hp4->name)->first();
                         if(!$komisi){
                          $komisi1=komisi::create([
                        
                        
                    'id-akun'=>$no_hp4->hp,
                    'id_nama'=>$no_hp4->name,
                    'jumlah'=>$order->harga_jual*20/100,
                    
                    
                    ]);
                    }
                    elseif($komisi){
                        
                        $jumlah=$komisi->jumlah;
                        $komisi->update([
                            'jumlah'=>$jumlah+$order->harga_jual*20/100,
                            'jumlah_sebelumnya'=>$jumlah,
                            
                            
                            ]);
                         
                         
                         
                     }
                    
                    
                    
                    
                    
                       $jurnal_intek=jurnal::create([
                    
                    'id_akun' =>$no_hp_intek->hp,
                     'id_nama'=>$no_hp_intek->name,
                    'keterangan'=>"pembelian ".$product->name,
                    'debet'=>1500,
                    'kredit'=>"0",
                    'ref_jurnal'=>$order->invoice,
                    
                    
                    ]);
                    
                    $jurnal_penjualan=jurnal::create([
                    
                    'id_akun' =>$no_hp_penjualan->hp,
                    'id_nama'=>$no_hp_penjualan->name,
                    'keterangan'=>"pembelian ".$product->name,
                    'debet'=>0,
                    'kredit'=>($order->harga_jual*50/100)+1500,
                    'ref_jurnal'=>$order->invoice,
                    
                    
                    ]);
                    
                    
                     $pendapatanhbm=jurnal::create([
                    
                    'id_akun' =>$no_hp_komisi->hp,
                    'id_nama' =>$no_hp_komisi->name,
                    'keterangan'=>"pembelian ".$product->name,
                    'debet'=>0,
                    'kredit'=>$order->harga_jual-($order->harga_jual*50/100+1500),
                    'ref_jurnal'=>$order->invoice,
                    
                    
                    ]);
                    
                    if(!empty($order->nilai_ongkir)){
                    $bebanongkir=jurnal::create([
                    
                    'id_akun' =>$bebanongkirhp->hp,
                    'id_nama' =>$bebanongkirhp->name,
                    'keterangan'=>"pembelian ".$product->name,
                    'debet'=>$order->nilai_ongkir,
                    'kredit'=>0,
                    'ref_jurnal'=>$order->invoice,
                    
                    
                    ]);
                   }
                    
                    
                    
                    
                    
                     if(!empty($order->potongan_voucher)){
                    $bebanvocher=jurnal::create([
                    
                    'id_akun' =>$bebanvocher->hp,
                    'id_nama' =>$bebanvocher->name,
                    'keterangan'=>"pembelian ".$product->name,
                    'debet'=>$order->potongan_voucher,
                    'kredit'=>0,
                    'ref_jurnal'=>$order->invoice,
                    
                    
                    ]);}
                    
                    
                    if(!empty($order->nilai_ongkir)){
                     $penampunganongkir=jurnal::create([
                    
                    'id_akun' =>$tampungongkir->hp,
                    'id_nama' =>$tampungongkir->name,
                    'keterangan'=>"pemebelian ".$product->name,
                    'debet'=>0,
                    'kredit'=>$order->nilai_ongkir,
                    'ref_jurnal'=>$order->invoice,
                    
                    
                    ]);}
                    if(!empty($order->potongan_voucher)){
                     $penampunganvocher=jurnal::create([
                    
                    'id_akun' =>$tampungvoucher->hp,
                    'id_nama' =>$tampungvoucher->name,
                    'keterangan'=>"pemebelian ".$product->name,
                    'debet'=>0,
                    'kredit'=>$order->potongan_voucher,
                    'ref_jurnal'=>$order->invoice,
                    
                    
                    ]);}
                    
                  return response()->json([
                    'state' => true,
                    'message' => 'barang sudah di terima',
                ], 200);  
            } 
                   
            
                else{
            
            return response()->json([
                'message' => 'barang bukan punya anda!!',
               
            ]);}
    
            }

           
    
    
    
    
    
    
    
    
    
            }
    }



    public function cari(Request $request){

 $jurnal=jurnal::orderBy('created_at','DESC')->paginate(10);
        
     $count=jurnal::count();

        if(!empty($request->akun)){

$jurnal=jurnal::where('id_akun','LIKE',"%$request->akun%")->paginate($count);

return view('jurnal.index',compact('jurnal'));




        }
        


   return view('jurnal.index',compact('jurnal'));


    }
    
    
    
    
    
    
}
