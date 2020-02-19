<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Sub_Category;
use App\Category;
use File;
use DB;
use Auth;
use Image;
use App\indukkategori;
class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);
        $sub_categories = Sub_Category::orderBy('sub_nama', 'desc')->paginate(10);
        return view('categories.index', compact('categories','sub_categories'));
    }
    
    
    
    public function cari(Request $request){
        $count=Category::count();
        $categories=Category::where('name','LIKE',"%$request->nama%")->paginate($count);
        
        return view('categories.index',compact('categories'));
        
    }
    
    
    public function categoryunggulan($unggulan){
        $unggulan = "ya";
        $categories = Category::where('unggulan', $unggulan)->get();
            if ($categories) {
                return response()->json([
                    'state' => true,
                    'message' => 'succes get data',
                    'data' => $categories
                ], 200);
            }
            return response()->json([
                'message' => 'failed get data',
                'data' => []
            ]);
    }
    
    public function melihatsub()
    {
        $sub = Sub_Category::select([
            'sub_categories.id',
            'categories.id as category_id',
            'categories.name as nama_kategori' ,
            'sub_nama',
            'sub_categories.description as description'
            ])
            ->join('categories','sub_categories.category_id','=','categories.id')
            ->get();
            
        if ($sub) {
                return response()->json([
                    'state' => true,
                    'message' => 'succes get data',
                    'data' => $sub
                ], 200);
            }
            return response()->json([
                'message' => 'failed get data',
                'data' => []
            ]);
    }
    
    public function liatcategorysub($detail)
    {
        $sub = Sub_Category::select([
            'sub_categories.id',
            'categories.id as category_id',
            'categories.name as nama_kategori' ,
            'sub_nama',
            'sub_categories.description as description'
            ])
            ->join('categories','sub_categories.category_id','=','categories.id')
            ->where('category_id', $detail)->get();
            
        if ($sub) {
                return response()->json([
                    'state' => true,
                    'message' => 'succes get data',
                    'data' => $sub
                ], 200);
            }
            return response()->json([
                'message' => 'failed get data',
                'data' => []
            ]);
    }
    
    
    public function create(){

    	 $indukkategori=indukkategori::all();
        return view('categories.create',compact('indukkategori'));
        
        
    }
    
    public function lihatbarang($id)
    {
        if (Auth::user()->hasPermissionTo('user')) 
         {
        $sub = 
              Product::select('products.id',
                  'products.code as code',
                  'products.harga_user as price',
                  'products.product_stock_id as product_stock_id',
                  'stock_kasirs.Jakarta as stock',
                  'products.description as description',
                  'products.weight as weight',
                  'products.lebar as lebar',
                  'products.tinggi as tinggi',
                  'products.volume as volume',
                  'products.photo as photo',
                  'products.photo_2 as photo_2',
                  'products.photo_3 as photo_3',
                  'categories.id as category_id',
                  'products.name as name', 
                  'products.unggulan as unggulan',
                  'categories.name as kategory',
                  'sub_categories.sub_nama as sub_kategory',
                  )
                  ->join('categories' ,'products.category_id','=','categories.id')
                   ->join('sub_categories' ,'products.sub_cat_id','=','sub_categories.id')
                   ->join('stock_kasirs','products.product_stock_id','=','stock_kasirs.id')
                    ->where('sub_cat_id', $id)
                  ->get();
         }else if (Auth::user()->hasPermissionTo('level1')) 
         {
            $sub = 
              Product::select('products.id',
                  'products.code as code',
                  'products.price_level1 as price',
                  'products.harga_user as price_user',
                  'products.product_stock_id as product_stock_id',
                  'stock_kasirs.Jakarta as stock',
                  'products.description as description',
                  'products.weight as weight',
                  'products.lebar as lebar',
                  'products.tinggi as tinggi',
                  'products.volume as volume',
                  'products.photo as photo',
                  'products.photo_2 as photo_2',
                  'products.photo_3 as photo_3',
                  'categories.id as category_id',
                  'products.name as name', 
                  'products.unggulan as unggulan',
                  'categories.name as kategory',
                  'sub_categories.sub_nama as sub_kategory',
                  )
                  ->join('categories' ,'products.category_id','=','categories.id')
                   ->join('sub_categories' ,'products.sub_cat_id','=','sub_categories.id')
                   ->join('stock_kasirs','products.product_stock_id','=','stock_kasirs.id')
                    ->where('sub_cat_id', $id)
                  ->get();         
                         
         }else if (Auth::user()->hasPermissionTo('level2')) 
         {
            $sub = 
              Product::select('products.id',
                  'products.code as code',
                  'products.price_level2 as price',
                  'products.harga_user as price_user',
                  'products.product_stock_id as product_stock_id',
                  'stock_kasirs.Jakarta as stock',
                  'products.description as description',
                  'products.weight as weight',
                  'products.lebar as lebar',
                  'products.tinggi as tinggi',
                  'products.volume as volume',
                  'products.photo as photo',
                  'products.photo_2 as photo_2',
                  'products.photo_3 as photo_3',
                  'categories.id as category_id',
                  'products.name as name', 
                  'products.unggulan as unggulan',
                  'categories.name as kategory',
                  'sub_categories.sub_nama as sub_kategory',
                  )
                  ->join('categories' ,'products.category_id','=','categories.id')
                   ->join('sub_categories' ,'products.sub_cat_id','=','sub_categories.id')
                   ->join('stock_kasirs','products.product_stock_id','=','stock_kasirs.id')
                    ->where('sub_cat_id', $id)
                  ->get();         
                         
         }else if (Auth::user()->hasPermissionTo('level3')) 
         {
            $sub = 
              Product::select('products.id',
                  'products.code as code',
                  'products.price_level3 as price',
                  'products.harga_user as price_user',
                  'products.product_stock_id as product_stock_id',
                  'stock_kasirs.Jakarta as stock',
                  'products.description as description',
                  'products.weight as weight',
                  'products.lebar as lebar',
                  'products.tinggi as tinggi',
                  'products.volume as volume',
                  'products.photo as photo',
                  'products.photo_2 as photo_2',
                  'products.photo_3 as photo_3',
                  'categories.id as category_id',
                  'products.name as name', 
                  'products.unggulan as unggulan',
                  'categories.name as kategory',
                  'sub_categories.sub_nama as sub_kategory',
                  )
                  ->join('categories' ,'products.category_id','=','categories.id')
                   ->join('sub_categories' ,'products.sub_cat_id','=','sub_categories.id')
                   ->join('stock_kasirs','products.product_stock_id','=','stock_kasirs.id')
                    ->where('sub_cat_id', $id)
                  ->get();         
                         
         }else if (Auth::user()->hasPermissionTo('level4')) 
         {
            $sub = 
              Product::select('products.id',
                  'products.code as code',
                  'products.price_level4 as price',
                  'products.harga_user as price_user',
                  'products.product_stock_id as product_stock_id',
                  'stock_kasirs.Jakarta as stock',
                  'products.description as description',
                  'products.weight as weight',
                  'products.lebar as lebar',
                  'products.tinggi as tinggi',
                  'products.volume as volume',
                  'products.photo as photo',
                  'products.photo_2 as photo_2',
                  'products.photo_3 as photo_3',
                  'categories.id as category_id',
                  'products.name as name', 
                  'products.unggulan as unggulan',
                  'categories.name as kategory',
                  'sub_categories.sub_nama as sub_kategory',
                  )
                  ->join('categories' ,'products.category_id','=','categories.id')
                   ->join('sub_categories' ,'products.sub_cat_id','=','sub_categories.id')
                   ->join('stock_kasirs','products.product_stock_id','=','stock_kasirs.id')
                    ->where('sub_cat_id', $id)
                  ->get();         
                         
         }
         
        if ($sub) {
                return response()->json([
                    'state' => true,
                    'message' => 'succes get data',
                    'data' => $sub
                ], 200);
            }
            return response()->json([
                'message' => 'failed get data',
                'data' => []
            ]);
    }
    
    

     public function getCategorylist()
    {
        
        $categories = Category::all();
            if ($categories) {
                return response()->json([
                    'state' => true,
                    'message' => 'succes get data',
                    'data' => $categories
                ], 200);
            }
            return response()->json([
                'message' => 'failed get data',
                'data' => []
            ]);
    }

  public function store (Request $request){
        
    
/*  $this->validate($request, [
           
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:100',
            'unggulan'=> 'required|string|max:100',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg',
            'tampil'=>'required',
            'next'=>'required',
            'induk_id'=>'required'
        ]);*/

        try {
            $photo = null;
            if ($request->hasFile('photo')) {
                $photo = $this->saveFile($request->title, $request->file('photo'));
            }
            
        
            $categories = category::create([
                'name' => $request->name,
                'description' => $request->description,
                'unggulan'=>$request->unggulan,
                'photo' => $photo,
                'tampil'=>$request->tampil,
                'next'=>$request->next,
                'induk_id'=>$request->induk_id
            ]);
            return redirect(route('index.category'))
                ->with(['success' => '<strong>' . $categories->name . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
        
    
        
        
        
        
        
    }
    
     private function saveFile($name, $photo)
    {
        $images = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension();
        $path = public_path('uploads/category');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        } 
        Image::make($photo)->save($path . '/' . $images);
        return $images;
    }
   

    public function destroy($id)
    {
        $categories = Category::findOrFail($id);
        $categories->delete();
        return redirect()->back()->with(['success' => 'Kategori: ' . $categories->name . ' Telah Dihapus']);
    }

    public function edit($id)
    {
        $categories = Category::where('id',$id)->first();
        $indukkategori=indukkategori::all();
         
        
        return view('categories.edit', compact('categories','indukkategori'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
           
            'name' => 'required|string|max:100',
            'deskripsi' => 'nullable|string|max:100',
            'unggulan'=> 'required|string|max:100',
            'tampil'=> 'required',
          
            'photo' => 'nullable|image|mimes:jpg,png,jpeg',
            'induk_id'=>'required'

            
           
        ]);


        try {
               $name = Category::findOrFail($id);
            $categories= Category::where('id',$id)->first();
             $photo = $categories->photo;
             if ($request->hasFile('photo')) {
                !empty($photo) ? File::delete(public_path('uploads/category/' . $photo)):null;
                $photo = $this->saveFile($request->name, $request->file('photo'));
            }
         
            $categories = Category::where('id',$id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'unggulan'=> $request->unggulan,
                'photo'=>$photo,

                'tampil'=>$request->tampil,
                'induk_id'=>$request->induk_id
            
                
            ]);
            return redirect(route('index.category'))->with(['success' => 'Kategori: ' . $name->name . ' Di update']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
public function induk(){

$indukkategori=indukkategori::paginate(10);


return view('categories.induk.index',compact('indukkategori')); 




}




public function createinduk(){

return view('categories.induk.create');




}



 public function storeinduk (Request $request){
        
    
  $this->validate($request, [
           
            'name' => 'required|string|max:100',
            'unggulan'=> 'required|string|max:100',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg',
            'tampil'=>'required',
            'next'=>'required',
            'next_product'=>'required',
            'next_content'=>'required',
        ]);

        try {
            $photo = null;
            if ($request->hasFile('photo')) {
                $photo = $this->saveFileinduk($request->name, $request->file('photo'));
            }
            
        
            $indukkategori = indukkategori::create([
                'name' => $request->name,
                'unggulan'=>$request->unggulan,
                'photo' => $photo,
                'tampil'=>$request->tampil,
                'deskripsi' => $request->deskripsi,
                'posisi'=>$request->posisi,
                'next'=>$request->next,
                'next_product'=>$request->next_product,
                'next_content'=>$request->next_content
       
            ]);
            return redirect(route('induk'))
                ->with(['success' => '<strong>' . $indukkategori->name . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
        
    
        
        
        
        
        
    }
    
     private function saveFileinduk($name, $photo)
    {
        $images = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension();
        $path = public_path('/uploads/category');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        } 
        Image::make($photo)->save($path . '/' . $images);
        return $images;
    }


    public function destroyinduk($id)
    {
        $indukkategori = indukkategori::findOrFail($id);
        $indukkategori->delete();
        return redirect()->back()->with(['success' => 'Kategori induk: ' . $indukkategori->name . ' Telah Dihapus']);
    }


    public function editinduk($id){

    	$indukkategori=indukkategori::where('id',$id)->first();


    	return view('categories.induk.edit',compact('indukkategori'));






    }


     public function editindukpost(Request $request, $id)
    {

        $this->validate($request, [
           
            'name' => 'required|string|max:100',
            'unggulan'=> 'required|string|max:100',
            'tampil'=> 'required',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg',
            'posisi'=>'required',
            'next'=>'required',
            'next_product'=>'required',
            'next_content'=>'required'

            
           
        ]);


        try {
               $name = indukkategori::findOrFail($id);
            $indukkategori= indukkategori::where('id',$id)->first();
             $photo = $indukkategori->photo;
             if ($request->hasFile('photo')) {
                !empty($photo) ? File::delete(public_path('uploads/category/' . $photo)):null;
                $photo = $this->saveFile($request->name, $request->file('photo'));
            }
         
            $indukkategori = indukkategori::where('id',$id)->update([
                'name' => $request->name,
                'unggulan'=> $request->unggulan,
                'photo'=>$photo,
                'tampil'=>$request->tampil,
                'deskripsi' => $request->deskripsi,
                'posisi'=>$request->posisi,
                'next'=>$request->next,
                'next_product'=>$request->next_product,
                'next_content'=>$request->next_content
            
                
            ]);
            return redirect(route('induk'))->with(['success' => 'Kategori induk: ' . $name->name . ' Di update']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function cariinduk(Request $request){
$count=indukkategori::count();
$indukkategori=indukkategori::where('name','LIKE',"%$request->nama%")->paginate($count);



return view('categories.induk.index',compact('indukkategori'));




    }





}
