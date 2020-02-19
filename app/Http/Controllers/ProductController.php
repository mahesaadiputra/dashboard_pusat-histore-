<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Sub_Category;
use App\Product;
use App\stock_kasir;
use App\Favorit;
use DB;
use Auth;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use File;
use Image;
use App\bagi_profit;
use App\indukkategori;
use App\barcode;
use App\barcodehistore;

class ProductController extends Controller
{
    
    
    
   
    
    public function caribarang(request $request){
        $this->validate($request, [
            'name' => 'required'
        ]);
        if (Auth::user()->hasPermissionTo('user')) 
         {
        $cari = 
              Product::select(
                  'products.id',
                  'code',
                  'name',
                  'products.harga_user as price',
                  'product_stock_id',
                  'stock_kasirs.Jakarta as stock',
                  'description',
                  'weight',
                  'category_id',
                  'photo',
                  'photo_2',
                  'photo_3',
                  'unggulan',
                  'created_at',
                  'updated_at')
                  ->join('stock_kasirs','products.product_stock_id','=','stock_kasirs.id')
                  ->where('name', 'LIKE',"%$request->name%")->get();
        }elseif (Auth::user()->hasPermissionTo('level1')) {
            $cari = 
              Product::select(
                  'products.id',
                  'code',
                  'name',
                  'products.price_level1 as price',
                  'products.harga_user as price_user',
                  'product_stock_id',
                  'stock_kasirs.Jakarta as stock',
                  'description',
                  'weight',
                  'category_id',
                  'photo',
                  'photo_2',
                  'photo_3',
                  'unggulan',
                  'created_at',
                  'updated_at')
                  ->join('stock_kasirs','products.product_stock_id','=','stock_kasirs.id')
                  ->where('name', 'LIKE',"%$request->name%")->get();
        }elseif (Auth::user()->hasPermissionTo('level2')) {
            $cari = 
              Product::select(
                  'products.id',
                  'code',
                  'name',
                  'products.price_level2 as price',
                  'products.harga_user as price_user',
                  'product_stock_id',
                  'stock_kasirs.Jakarta as stock',
                  'description',
                  'weight',
                  'category_id',
                  'photo',
                  'photo_2',
                  'photo_3',
                  'unggulan',
                  'created_at',
                  'updated_at')
                  ->join('stock_kasirs','products.product_stock_id','=','stock_kasirs.id')
                  ->where('name', 'LIKE',"%$request->name%")->get();
        }elseif (Auth::user()->hasPermissionTo('level3')) {
            $cari = 
              Product::select(
                  'products.id',
                  'code',
                  'name',
                  'products.price_level3 as price',
                  'products.harga_user as price_user',
                  'product_stock_id',
                  'stock_kasirs.Jakarta as stock',
                  'description',
                  'weight',
                  'category_id',
                  'photo',
                  'photo_2',
                  'photo_3',
                  'unggulan',
                  'created_at',
                  'updated_at')
                  ->join('stock_kasirs','products.product_stock_id','=','stock_kasirs.id')
                  ->where('name', 'LIKE',"%$request->name%")->get();
        }elseif (Auth::user()->hasPermissionTo('level4')) {
            $cari = 
              Product::select(
                  'products.id',
                  'code',
                  'name',
                  'products.price_level4 as price',
                  'products.harga_user as price_user',
                  'product_stock_id',
                  'stock_kasirs.Jakarta as stock',
                  'description',
                  'weight',
                  'category_id',
                  'photo',
                  'photo_2',
                  'photo_3',
                  'unggulan',
                  'created_at',
                  'updated_at')
                  ->join('stock_kasirs','products.product_stock_id','=','stock_kasirs.id')
                  ->where('name', 'LIKE',"%$request->name%")->get();
        }
        if ($cari) {
            return response()->json([
                'state' => true,
                'status' => 'success',
                'data' => $cari
            ], 200);
        }else if(!$cari){
        return response()->json([
            'status' => 'failed',
            'data' => []
        ]);
        }
    }
    
    public function index(request $request)
    {
        $products = Product::with('category')->orderBy('category_id', 'ASC')->paginate(10);
        $induk_id = indukkategori::orderBy('name', 'ASC')->get();
        $categories = Category::orderBy('name', 'ASC')->get();
        $sub_categories = Sub_Category::orderBy('sub_nama', 'ASC')->get();
        
        return view('products.index', 
        compact('products','sub_categories','induk_id','categories'));
      
    }

    public function create()
    {
       $categories['data'] = Sub_Category::getcategory();
       $induk_id = indukkategori::orderBy('name', 'ASC')->get();
   
        return view('products.create', compact('categories','induk_id'));
    }



  
    public function getsubcat($subcat=0){
        
        
        $sub_cat['data']= Sub_Category::getsubcat($subcat);
         echo json_encode($sub_cat);
     exit;
        
        
        
        
        
    }


   public function store(Request $request)
    {
        $this->validate($request, [
           
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:800',
            'price' => 'required|integer',
            'weight' => 'required',
             'tinggi' => 'required',
              'lebar' => 'required',
               'volume' => 'required',
               'unggulan' => 'required',
               'tampil'=>'required',
                 'minimum1' => 'required|integer',
                  'minimum2' => 'required|integer',
                   'minimum3' => 'required|integer',
                    'minimum4' => 'required|integer',
                    'itki'=>'required',
                    'nama_umkm'=>'required',
                    'alamat_umkm'=>'required',
                 
            'category' => 'required|exists:categories,id',
            'sub_cat' => 'required|exists:sub_categories,id',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg',
               'photo2' => 'nullable|image|mimes:jpg,png,jpeg',
                  'photo3' => 'nullable|image|mimes:jpg,png,jpeg'
               
        ]);

        try {
            $photo = null;
            if ($request->hasFile('photo')) {
                $photo = $this->saveFile($this->generateRandomString(16), $request->file('photo'));
            }
            
            
             $photo2 = null;
            if ($request->hasFile('photo2')) {
                $photo2 = $this->saveFile2($this->generateRandomString(16), $request->file('photo2'));
            }
            
              $photo3 = null;
            if ($request->hasFile('photo3')) {
                $photo3 = $this->saveFile3($this->generateRandomString(16), $request->file('photo3'));
            }
            
            
       
            
            $profit_1=bagi_profit::where('jenis_bintang','Bintang 1')->first();
             $profit_2=bagi_profit::where('jenis_bintang','Bintang 2')->first();
              $profit_3=bagi_profit::where('jenis_bintang','Bintang 3')->first();
              $profit_4=bagi_profit::where('jenis_bintang','Bintang 4')->first();
              $profit_u=bagi_profit::where('jenis_bintang','user')->first();
        
        $total=$request->harga_user-$request->price;
   

$hasilbintang4=$total*$profit_4->profit/100;
$hasilbintang3=$total*$profit_3->profit/100;
$hasilbintang2=$total*$profit_2->profit/100;
$hasilbintang1=$total*$profit_1->profit/100;




            $product = Product::create([
                // $insertid = $stock_kasir->id,
                'code' => $request->kode,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
  /*              'harga_user'=> $request->harga_user,*/
                'minimum_level_1' => $request->minimum1,
                'minimum_level_2' => $request->minimum2,
                'minimum_level_3' => $request->minimum3,
                'minimum_level_4' =>  $request->minimum4,
                'price_level1'=>$request->price+$hasilbintang4+$hasilbintang3+$hasilbintang2+$hasilbintang1,
                 'price_level2'=>$request->price+$hasilbintang4+$hasilbintang3+$hasilbintang2,
                  'price_level3'=>$request->price+$hasilbintang4+$hasilbintang3,
                   'price_level4'=>$request->price+$hasilbintang4,
                'weight' => $request->weight,
                'tinggi'=> $request->tinggi,
                'lebar'=> $request->lebar,
                'volume'=>$request->volume,
                'unggulan'=>$request->unggulan,
                'tampil'=>$request->tampil,
                'induk_id'=>$request->induk_id,
                'category_id' => $request->category,
                'sub_cat_id' => $request->sub_cat,
                'photo' => $photo,
                 'photo_2' => $photo2,
                   'photo_3' => $photo3,
                   'itki'=>$request->itki,
                   'histore'=>$request->histore,
                   'nama_umkm'=>$request->nama_umkm,
                   'alamat_umkm'=>$request->alamat_umkm
            ]);
            return redirect(route('produk.index'))
                ->with(['success' => '<strong>' . $product->name . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    private function saveFile($name, $photo)
    {
        $images = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension();
        $path = public_path('uploads/product');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        } 
        Image::make($photo)->save($path . '/' . $images);
        return $images;
    }

    
    private function saveFile2($name, $photo2)
    {
        $images = str_slug($name) . time() . '.' . $photo2->getClientOriginalExtension();
        $path = public_path('uploads/product');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        } 
        Image::make($photo2)->save($path . '/' . $images);
        return $images;
    }
     private function saveFile3($name, $photo3)
    {
        $images = str_slug($name) . time() . '.' . $photo3->getClientOriginalExtension();
        $path = public_path('uploads/product');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        } 
        Image::make($photo3)->save($path . '/' . $images);
        return $images;
    }
    
    
    



    public function destroy($id)
    {
        $products = Product::findOrFail($id);
        if (!empty($products->photo)) {
            File::delete(public_path('uploads/product/' . $products->photo));
        }
        $products->delete();
        return redirect()->back()->with(['success' => '<strong>' . $products->name . '</strong> Telah Dihapus!']);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $induk_id = indukkategori::orderBy('name', 'ASC')->get();
        $categories = Category::orderBy('name', 'ASC')->get();
        $sub_categories = Sub_Category::orderBy('sub_nama', 'ASC')->get();
        return view('products.edit', compact('product', 'categories','sub_categories','induk_id'));
    }
    
    
    
    
    public function view($id)
    {
        $product = Product::findOrFail($id);
        $induk_id = indukkategori::orderBy('name', 'ASC')->get();
        $categories = Category::orderBy('name', 'ASC')->get();
        $sub_categories = Sub_Category::orderBy('sub_nama', 'ASC')->get();
        return view('products.view', compact('product', 'categories','sub_categories'));
    }

   public function update(Request $request, $id)
    {
        $this->validate($request, [
            'code' => 'required|string|max:10|exists:products,code',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|integer',
             'minimum1' => 'required|integer',
             'minimum2' => 'required|integer',
             'minimum3' => 'required|integer',
             'minimum4' => 'required|integer',
             'harga_user'=>'required',
            'weight' => 'required',
            'lebar'=>'required',
            'tinggi'=>'required',
            'volume'=>'required',
            'unggulan'=> 'required',
            'tampil'=>'required',
            'itki'=>'required',
            'category_id' => 'required|exists:categories,id',
            'sub_cat_id' => 'required|exists:sub_categories,id',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg',
             'photo2' => 'nullable|image|mimes:jpg,png,jpeg',
              'photo3' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        try {
            $product = Product::findOrFail($id);
            $photo = $product->photo;

            if ($request->hasFile('photo')) {
                !empty($photo) ? File::delete(public_path('uploads/product/' . $photo)):null;
                $photo = $this->saveFile($this->generateRandomString(16), $request->file('photo'));
            }
            
             $photo2 = $product->photo_2;
             if ($request->hasFile('photo2')) {
                !empty($photo2) ? File::delete(public_path('uploads/product/' . $photo2)):null;
                $photo2 = $this->saveFile2($this->generateRandomString(16), $request->file('photo2'));
            }
            $photo3 = $product->photo_3;
             if ($request->hasFile('photo3')) {
                !empty($photo3) ? File::delete(public_path('uploads/product/' . $photo3)):null;
                $photo3 = $this->saveFile3($this->generateRandomString(16), $request->file('photo3'));
            }



           $profit_1=bagi_profit::where('jenis_bintang','Bintang 1')->first();
             $profit_2=bagi_profit::where('jenis_bintang','Bintang 2')->first();
              $profit_3=bagi_profit::where('jenis_bintang','Bintang 3')->first();
              $profit_4=bagi_profit::where('jenis_bintang','Bintang 4')->first();
              $profit_u=bagi_profit::where('jenis_bintang','user')->first();
        
        $total=$request->harga_user-$request->price;
   

$hasilbintang4=$total*$profit_4->profit/100;
$hasilbintang3=$total*$profit_3->profit/100;
$hasilbintang2=$total*$profit_2->profit/100;
$hasilbintang1=$total*$profit_1->profit/100;



            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'harga_user'=> $request->harga_user,
                'price_level1'=>$request->price+$hasilbintang4+$hasilbintang3+$hasilbintang2+$hasilbintang1,
                 'price_level2'=>$request->price+$hasilbintang4+$hasilbintang3+$hasilbintang2,
                  'price_level3'=>$request->price+$hasilbintang4+$hasilbintang3,
                   'price_level4'=>$request->price+$hasilbintang4,
                'minimum_level_1'=> $request->minimum1,
                  'minimum_level_2'=> $request->minimum2,
                    'minimum_level_3'=> $request->minimum3,
                      'minimum_level_4'=> $request->minimum4,
                'weight' => $request->weight,
                'lebar' => $request->lebar,
                'tinggi'=> $request->tinggi,
                'volume'=> $request->volume,
                'unggulan'=> $request->unggulan,
                'tampil'=>$request->tampil,
                'induk_id'=>$request->induk_id,
                'category_id' => $request->category_id,
                'sub_cat_id' => $request->sub_cat_id,
                'photo' => $photo,
                 'photo_2' => $photo2,
                 'photo_3'=>$photo3,
                 'itki'=>$request->itki,
                 'histore'=>$request->histore,                 
                 'nama_umkm'=>$request->nama_umkm,
                 'alamat_umkm'=>$request->alamat_umkm
            ]);

            return redirect(route('produk.index'))
                ->with(['success' => '<strong>' . $product->name . '</strong> Diperbaharui']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }
    
      public function cari(Request $request)
    {
        $cari= $request->nama;
        $count=product::count();
        $id=$request->categories;
         $induk_id = indukkategori::orderBy('name', 'ASC')->get();
        $products = Product::with('category')->orderBy('category_id', 'ASC')->paginate(10);
            $categories = Category::orderBy('name', 'ASC')->get();
         if (!empty($request->categories)) {
            $products = product::orderBy('id', 'DESC')
            ->with('category')
            ->where('category_id', $id)
            ->paginate($count)
            ->setpath('');
             $categories = Category::orderBy('name', 'ASC')->get();
             
        }
          if (!empty($request->nama)) {
            $products = product::orderBy('id', 'DESC')
            ->with('category')
            ->where('name','LIKE', "%$cari%")
            ->paginate($count)
            ->setpath('');  
             $categories = Category::orderBy('name', 'ASC')->get();
            
        }
        if (!empty($request->induk)) {
            $products = product::orderBy('id', 'DESC')
            ->with('category')
            ->where('induk_id',$request->induk)
            ->paginate($count)
            ->setpath('');
             $categories = Category::orderBy('name', 'ASC')->get();
            
        }
           
         return view('products.index',  compact('products','categories','induk_id'));
       
        
    
     
    
}






public function storeitki(Request $request)
    {
       

        
            $photo = null;
            if ($request->hasFile('photo')) {
                $photo = $this->saveFile($this->generateRandomString(16), $request->file('photo'));
            }
            
            
             $photo2 = null;
            if ($request->hasFile('photo2')) {
                $photo2 = $this->saveFile2($this->generateRandomString(16), $request->file('photo2'));
            }
            
              $photo3 = null;
            if ($request->hasFile('photo3')) {
                $photo3 = $this->saveFile3($this->generateRandomString(16), $request->file('photo3'));
            }

            $barcode=null;
                if ($request->hasFile('barcode')) {
                $barcode = $this->saveFilebarcode($this->generateRandomString(16), $request->file('barcode'));
            }
            
            $profit_1=bagi_profit::where('jenis_bintang','Bintang 1')->first();
             $profit_2=bagi_profit::where('jenis_bintang','Bintang 2')->first();
              $profit_3=bagi_profit::where('jenis_bintang','Bintang 3')->first();
              $profit_4=bagi_profit::where('jenis_bintang','Bintang 4')->first();
              $profit_u=bagi_profit::where('jenis_bintang','user')->first();
        
        $total=$request->harga_user-$request->price;
   

$hasilbintang4=$total*$profit_4->profit/100;
$hasilbintang3=$total*$profit_3->profit/100;
$hasilbintang2=$total*$profit_2->profit/100;
$hasilbintang1=$total*$profit_1->profit/100;
            
           
        
            $product = Product::create([
                'code' => $request->kode,
                'name' => $request->name,
                'description' => $request->description,
                 'price_level1'=>$request->price+$hasilbintang4+$hasilbintang3+$hasilbintang2+$hasilbintang1,
                 'price_level2'=>$request->price+$hasilbintang4+$hasilbintang3+$hasilbintang2,
                  'price_level3'=>$request->price+$hasilbintang4+$hasilbintang3,
                   'price_level4'=>$request->price+$hasilbintang4,
                'price' => $request->price,
                'weight' => $request->weight,
                'tinggi'=> $request->tinggi,
                'lebar'=> $request->lebar,
                'volume'=>$request->volume,
                'unggulan'=>$request->unggulan,
                'induk_id'=>$request->induk_id,
                'category_id' => $request->category,
                'sub_cat_id' => $request->sub_cat,
                'photo' => $photo,
                'barcode'=>$barcode,
                 'photo_2' => $photo2,
                   'photo_3' => $photo3,
                   'itki'=>$request->itki,
                   'histore'=>"tidak"
            ]);

            $bar=barcode::create(
              [
              'barcode'=>$request->kode,
              'nama'=>$request->name,
              'product_id'=>$product->id


          ]);
            
if ($product && $bar){

return response()->json([
'message'=>'product berhasil di buat',
'product'=>$product,
'state'=> true


]);


}


return response()->json([

'message' => 'product gagal di buat']);

  






            }


  private function saveFilebarcode($name, $photo)
    {
        $images = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension();
        $path = public_path('uploads/barcode');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        } 
        Image::make($photo)->save($path . '/' . $images);
        return $images;
    }


            public function hapusphoto($photo){


$cek=$photo;
            $file=File::delete(public_path('/uploads/product/'.$cek));
            $product=product::where('photo',$photo)->first();
            $product->update([
              'photo'=>null]);
         
if($product){


             return redirect()->back()->with(['success'=>'berhasil hapus photo']);



}else{

  return "gagal";
}

  
            }



               public function hapusphoto2($photo){


$cek=$photo;
            $file=File::delete(public_path('/uploads/product/'.$cek));
            $product=product::where('photo_2',$photo)->first();
            $product->update([
              'photo_2'=>null]);
         
if($product){


              return redirect()->back()->with(['success'=>'berhasil hapus photo']);


}else{

  return "gagal";
}

  
            }


              public function hapusphoto3($photo){


$cek=$photo;
            $file=File::delete(public_path('/uploads/product/'.$cek));
            $product=product::where('photo_3',$photo)->first();
            $product->update([
              'photo_3'=>null]);
         
if($product){


              return redirect()->back()->with(['success'=>'berhasil hapus photo']);


}else{

  return "gagal";
}

  
            }


            public function updateitki(Request $request){



                 $product = Product::findOrFail($request->id);
            $photo = $product->photo;

            if ($request->hasFile('photo')) {
                !empty($photo) ? File::delete(public_path('uploads/product/' . $photo)):null;
                $photo = $this->saveFile($this->generateRandomString(16), $request->file('photo'));
            }
            
             $photo2 = $product->photo_2;
             if ($request->hasFile('photo2')) {
                !empty($photo2) ? File::delete(public_path('uploads/product/' . $photo2)):null;
                $photo2 = $this->saveFile2($this->generateRandomString(16), $request->file('photo2'));
            }
            $photo3 = $product->photo_3;
             if ($request->hasFile('photo3')) {
                !empty($photo3) ? File::delete(public_path('uploads/product/' . $photo3)):null;
                $photo3 = $this->saveFile3($this->generateRandomString(16), $request->file('photo3'));
            }



           $profit_1=bagi_profit::where('jenis_bintang','Bintang 1')->first();
             $profit_2=bagi_profit::where('jenis_bintang','Bintang 2')->first();
              $profit_3=bagi_profit::where('jenis_bintang','Bintang 3')->first();
              $profit_4=bagi_profit::where('jenis_bintang','Bintang 4')->first();
              $profit_u=bagi_profit::where('jenis_bintang','user')->first();
        
        $total=$request->harga_user-$request->price;
   

$hasilbintang4=$total*$profit_4->profit/100;
$hasilbintang3=$total*$profit_3->profit/100;
$hasilbintang2=$total*$profit_2->profit/100;
$hasilbintang1=$total*$profit_1->profit/100;



            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'harga_user'=> $request->harga_user,
                'price_level1'=>$request->price+$hasilbintang4+$hasilbintang3+$hasilbintang2+$hasilbintang1,
                 'price_level2'=>$request->price+$hasilbintang4+$hasilbintang3+$hasilbintang2,
                  'price_level3'=>$request->price+$hasilbintang4+$hasilbintang3,
                   'price_level4'=>$request->price+$hasilbintang4,
                'minimum_level_1'=> $request->minimum1,
                  'minimum_level_2'=> $request->minimum2,
                    'minimum_level_3'=> $request->minimum3,
                      'minimum_level_4'=> $request->minimum4,
                'weight' => $request->weight,
                'lebar' => $request->lebar,
                'tinggi'=> $request->tinggi,
                'volume'=> $request->volume,
                'unggulan'=> $request->unggulan,
                'itki'=>"ya",
                'induk_id'=>"7",
                'category_id' => $request->category_id,
                'sub_cat_id' => $request->sub_cat_id,
                'photo' => $photo,
                 'photo_2' => $photo2,
                 'photo_3'=>$photo3,
                 'nama_umkm'=>$request->nama_umkm,
                 'alamat_umkm'=>$request->alamat_umkm
            ]);




            if($product){

              return response()->json(['message'=>"product berhasil di update",
                'product'=>$product,
                'state'=>true]);
            }

            }



            public function deletebarcode(Request $req){

$filePath = 'uploads/barcode/'.$req->photo;
 File::delete($filePath);


            }













public function storehistore(Request $request)
    {
       

        
                  $photo = null;
            if ($request->hasFile('photo')) {
                $photo = $this->saveFile($this->generateRandomString(16), $request->file('photo'));
                                            }
            
            
                      $photo2 = null;
            if ($request->hasFile('photo2')) {
                $photo2 = $this->saveFile2($this->generateRandomString(16), $request->file('photo2'));
                                             }
            
              $photo3 = null;
            if ($request->hasFile('photo3')) {
                $photo3 = $this->saveFile3($this->generateRandomString(16), $request->file('photo3'));
                                              }

            $barcode=null;
                if ($request->hasFile('barcode')) {
                $barcode = $this->saveFilebarcode($this->generateRandomString(16), $request->file('barcode'));
                                                }
            
              $profit_1=bagi_profit::where('jenis_bintang','Bintang 1')->first();
              $profit_2=bagi_profit::where('jenis_bintang','Bintang 2')->first();
              $profit_3=bagi_profit::where('jenis_bintang','Bintang 3')->first();
              $profit_4=bagi_profit::where('jenis_bintang','Bintang 4')->first();
              $profit_u=bagi_profit::where('jenis_bintang','user')->first();
        
                $total=$request->harga_user-$request->price;
                $hasilbintang4=$total*$profit_4->profit/100;
                $hasilbintang3=$total*$profit_3->profit/100;
                $hasilbintang2=$total*$profit_2->profit/100;
                $hasilbintang1=$total*$profit_1->profit/100;
            
           
        
            $product = Product::create([
                'code' => $request->kode,
                'name' => $request->name,
                'description' => $request->description,
                'price_level1'=>$request->price+$hasilbintang4+$hasilbintang3+$hasilbintang2+$hasilbintang1,
                'price_level2'=>$request->price+$hasilbintang4+$hasilbintang3+$hasilbintang2,
                'price_level3'=>$request->price+$hasilbintang4+$hasilbintang3,
                'price_level4'=>$request->price+$hasilbintang4,
                'price' => $request->price,
                'weight' => $request->weight,
                'tinggi'=> $request->tinggi,
                'lebar'=> $request->lebar,
                'volume'=>$request->volume,
                'unggulan'=>$request->unggulan,
                'induk_id'=>$request->induk_id,
                'category_id' => $request->category,
                'sub_cat_id' => $request->sub_cat,
                'photo' => $photo,
                'barcode'=>$barcode,
                'photo_2' => $photo2,
                'photo_3' => $photo3,
                'tampil' => $request->tampil,
                'itki'=>"tidak",
                'histore'=>"ya"
            ]);

            $bar=barcodehistore::create(
              [
              'barcode'=>$request->kode,
              'product_id'=>$product->id


          ]);
            
if ($product && $bar){

return response()->json([
'message'=>'product berhasil di buat',
'product'=>$product,
'state'=> true


]);


}


return response()->json([

'message' => 'product gagal di buat']);

  






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




public function updatehistore(Request $request){



                 $product = Product::findOrFail($request->id);
            $photo = $product->photo;

            if ($request->hasFile('photo')) {
                !empty($photo) ? File::delete(public_path('uploads/product/' . $photo)):null;
                $photo = $this->saveFile($this->generateRandomString(16), $request->file('photo'));
            }
            
             $photo2 = $product->photo_2;
             if ($request->hasFile('photo2')) {
                !empty($photo2) ? File::delete(public_path('uploads/product/' . $photo2)):null;
                $photo2 = $this->saveFile2($this->generateRandomString(16), $request->file('photo2'));
            }
            $photo3 = $product->photo_3;
             if ($request->hasFile('photo3')) {
                !empty($photo3) ? File::delete(public_path('uploads/product/' . $photo3)):null;
                $photo3 = $this->saveFile3($this->generateRandomString(16), $request->file('photo3'));
            }



           $profit_1=bagi_profit::where('jenis_bintang','Bintang 1')->first();
             $profit_2=bagi_profit::where('jenis_bintang','Bintang 2')->first();
              $profit_3=bagi_profit::where('jenis_bintang','Bintang 3')->first();
              $profit_4=bagi_profit::where('jenis_bintang','Bintang 4')->first();
              $profit_u=bagi_profit::where('jenis_bintang','user')->first();
        
        $total=$request->harga_user-$request->price;
   

$hasilbintang4=$total*$profit_4->profit/100;
$hasilbintang3=$total*$profit_3->profit/100;
$hasilbintang2=$total*$profit_2->profit/100;
$hasilbintang1=$total*$profit_1->profit/100;



            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'harga_user'=> $request->harga_user,
                'price_level1'=>$request->price+$hasilbintang4+$hasilbintang3+$hasilbintang2+$hasilbintang1,
                 'price_level2'=>$request->price+$hasilbintang4+$hasilbintang3+$hasilbintang2,
                  'price_level3'=>$request->price+$hasilbintang4+$hasilbintang3,
                   'price_level4'=>$request->price+$hasilbintang4,
                'minimum_level_1'=> $request->minimum1,
                  'minimum_level_2'=> $request->minimum2,
                    'minimum_level_3'=> $request->minimum3,
                      'minimum_level_4'=> $request->minimum4,
                      'tampil'=>$request->tampil,
                'weight' => $request->weight,
                'lebar' => $request->lebar,
                'tinggi'=> $request->tinggi,
                'volume'=> $request->volume,
                'unggulan'=> $request->unggulan,
                'itki'=>"tidak",
                'histore'=>"ya",
                'induk_id'=>$request->induk,
                'category_id' => $request->category_id,
                'sub_cat_id' => $request->sub_cat_id,
                'photo' => $photo,
                 'photo_2' => $photo2,
                 'photo_3'=>$photo3,
                 'nama_umkm'=>$request->nama_umkm,
                 'alamat_umkm'=>$request->alamat_umkm
            ]);




            if($product){

              return response()->json(['message'=>"product berhasil di update",
                'product'=>$product,
                'state'=>true]);
            }

            }














}
