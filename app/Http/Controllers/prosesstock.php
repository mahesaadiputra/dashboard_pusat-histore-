<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\proses_request;
use App\stock_kasir;
use Auth;
use App\User;
use App\konfirmasi;
use App\user_cabang;
use File;
use Image;
use Carbon\Carbon;



class prosesstock extends Controller
{
    
     
     public function index_admin(Request $request)
    {

      
        if(!empty($request->nama)){

          $jumlah=konfirmasi::count();
$proses_request=konfirmasi::where('nama_product','LIKE',"%$request->nama%")->where('role','pusat')->paginate($jumlah);

 return view('request.proses.index',[ 'proses_request'=> $proses_request,
            ]);



        }
        if(!empty($request->cabang)){

          $jumlah=konfirmasi::count();
$proses_request=konfirmasi::where('nama_cabang','LIKE',"%$request->cabang%")->where('role','pusat')->paginate($jumlah);

 return view('request.proses.index',[ 'proses_request'=> $proses_request,
            ]);



        }


        if(!empty($request->status)){
   $jumlah=konfirmasi::count();
if($request->status == 1){

$status = 0;

}elseif ($request->status == 2) {
  $status =1; 
}


$proses_request=konfirmasi::where('status',$status)->where('role','pusat')->paginate($jumlah);

  return view('request.proses.index',[ 'proses_request'=> $proses_request,
            ]);




        }
       
        $proses_request = konfirmasi::Orderby('id','desc' )->where('role','pusat')->paginate(10);
        
       return view('request.proses.index',[ 'proses_request'=> $proses_request,
            ]);
      
    }
    
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('request.proses.request', compact('product', 'categories'));
    }
    
    
    
    
    
    
     public function store(Request $request)
    {


       
          
           
              $proses_request = proses_request::create([

         'cabang_bandung'=>$request->stock_id,
  'jumlah_request'=>$request->stock,
  'nama_product'=>$request->name,
  'photo'=>$request->photo,
  'nama_cabang'=>$request->nama_cabang,
  
  
  
            ]);
          $nama = auth()->user()->name;
      $proses_request = proses_request::Orderby('id','desc' )->where('nama_cabang',$nama)->paginate(10);
       return view('request.proses.index',[ 'proses_request'=> $proses_request,
            ]);
            
            
            
     
    }



    private function saveFile($name, $photo)
    {
        $images = $name;
        $path = public_path('uploads/barcode');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        } 
        Image::make($photo)->save($path . '/' . $images);
        return $images;
    }
    




 public function review($id)
    {
       $proses_request = konfirmasi::select(
'nama_product',
'jumlah_request',
'products.barcode',
'product_id',
'approval.id as id',
'approval.user_id',
'approval.nama_cabang'

       )->join('products','products.id','=','approval.product_id')
       ->where('approval.id',$id)
       ->get();
      
       return view('request.proses.edit',[ 'proses_request'=> $proses_request,
            
            
            
            ]);
      
    }
    
    
      public function kirim(Request $request)
    {
     
     
   $this->validate($request, [
           
                  'barcode' => 'image|mimes:jpg,png,jpeg'
               
        ]);

     $photo = null;
            if ($request->hasFile('barcode')) {
                $photo = $this->saveFile($this->generateRandomString(16), $request->file('barcode'));
            }
     


$proses=konfirmasi::where('id',$request->id)->first();
$mahesa=proses_request::where('user_id',$request->userid)->where('product_id',$request->id_order)->first();


$jumlah=$mahesa->sisa_stock;
$sisa=$mahesa->jumlah_request;
/*$mahesa->update([
  'sisa_stock'=>$jumlah+$request->stock,
  'jumlah_request'=>$sisa-$request->stock

]);
*/






$proses->update([
'status'=> 1,
'waktu_kirim'=>Carbon::now(),
'barcode'=>$photo


]);











           
       return redirect()->route('proses.status.admin');
         
         
     
    }
     public function cari_proses(Request $request)
    {
        $cari= $request->nama;
        $id=$request->cabang;
      
        
         if (!empty($request->cabang)) {
          $proses_request=proses_request::orderBy('id', 'DESC')->where('nama_cabang', $id)->paginate(1000);
            return view('request.proses.index',  compact('proses_request'));
        }
          if (!empty($request->nama)) {
           $nama = auth()->user()->name;
      $proses_request= proses_request::orderBy('id', 'DESC')
      ->where('nama_product', $cari)
      ->where('nama_cabang',$nama)
      ->paginate(1000);
        return view('request.proses.index',  compact('proses_request'));
        }
         if (!empty($request->status)) {
            $nama = auth()->user()->name;
     $proses_request= proses_request::orderBy('id', 'DESC')
     ->where('nama_cabang',$nama)
     ->where('status', $request->status)->paginate(1000);
             return view('request.proses.index',  compact('proses_request'));
        }
        
        
        
       
        
    
     
    
}



     public function cari_proses_admin(Request $request)
    {
        $cari= $request->nama;
        $id=$request->cabang;
      
        
         if (!empty($request->cabang)) {
          $proses_request=proses_request::orderBy('id', 'DESC')->where('nama_cabang', $id)->paginate(1000);
            return view('request.proses.index',  compact('proses_request'));
        }
          if (!empty($request->nama)) {
           $nama = auth()->user()->name;
      $proses_request= proses_request::orderBy('id', 'DESC')
      ->where('nama_product', $cari)
      ->where('nama_cabang',$nama)
      ->paginate(1000);
       
        }
         if (!empty($request->status)) {
           
     $proses_request= proses_request::orderBy('id', 'DESC')
    
     ->where('status', $request->status)->paginate(1000);
          
        }
        
           return view('request.proses.index',  compact('proses_request'));
        
       
        
    
     
    
}


public function kirimcabang($id){



$product=product::where('id',$id)->first();

$kategori=Category::where('id',$product->category_id)->first();




$cabang=user_cabang::orderBy('name','ASC')->get();



return view('proses.edit',[ 'proses_request'=> $product,'cabang'=>$cabang,'kategori'=>$kategori
            ]);






}

 public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

public function kirimkecabang(Request $request ){

   $this->validate($request, [
           
                  'barcode' => 'image|mimes:jpg,png,jpeg'
               
        ]);

     $photo = null;
            if ($request->hasFile('barcode')) {
                $photo = $this->saveFile($this->generateRandomString(16), $request->file('barcode'));
            }
     

$product=proses_request::where('user_id',$request->cabang)->where('product_id',$request->id)->first();



if($product){
  $jumlah=$product->jumlah_request;
  $cabang=user_cabang::where('id',$request->cabang)->first();
$id=$request->id;
$userid=$request->cabang;
$nama=$cabang->name;
$role=$cabang->role;
  
$product->update([

  'jumlah_request'=>$jumlah+$request->stock,



]);

$konfirmasi=konfirmasi::create([
	'user_id'=>$userid,
'nama_product'=>$request->name,
'kategori'=>$request->kategori,
'product_id'=>$id,
'nama_cabang'=>$nama,
'jumlah_request'=>$request->stock,
'photo'=>$request->photo,
'barcode'=>$photo,
'status'=>1,
'role'=>$role

]);



return redirect()->route('proses.status.admin')->with(['success' => '<strong>' . $konfirmasi->nama_product . '</strong> Ditambahkan']);
}

elseif(!$product){

  $cabang=user_cabang::where('id',$request->cabang)->first();
$id=$request->id;
$userid=$request->cabang;
$nama=$cabang->name;
$role=$cabang->role;
proses_request::create([
'user_id'=>$userid,
'nama_product'=>$request->name,
'kategori'=>$request->kategori,
'product_id'=>$id,
'nama_cabang'=>$nama,
'jumlah_request'=>$request->stock,
'photo'=>$request->photo




]);



$konfirmasi=konfirmasi::create([
	'user_id'=>$userid,
'nama_product'=>$request->name,
'kategori'=>$request->kategori,
'product_id'=>$id,
'nama_cabang'=>$nama,
'jumlah_request'=>$request->stock,
'photo'=>$request->photo,
'barcode'=>$photo,
'role'=>$role,
'status'=>1








]);


return redirect()->route('proses.status.admin')->with(['success' => '<strong>' . $konfirmasi->nama_product . '</strong> di kirim']);;


}



}
    
    
    
public function savebarcode(Request $request){

  $photo = null;
            if ($request->hasFile('barcode')) {
                $photo = $this->saveFile($request->file('barcode')->getClientOriginalName(), $request->file('barcode'));


                return response()->json([
'simpan photo berhasil'

                ]);
            }
     



}




    
    
}
