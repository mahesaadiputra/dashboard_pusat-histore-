<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\stock_kasir;
use File;
use DB;
use Image;


class StockController extends Controller
{
   public function index()
    {
         $products = Product::with('category')->orderBy('category_id', 'asc')->paginate(10);
        $categories = Category::orderBy('name', 'ASC')->get();
      
        
        
        return view('request.index', 
        compact('products'),
        compact('categories'));
      
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|string|max:10|unique:products',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:100',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        try {
            $photo = null;
            if ($request->hasFile('photo')) {
                $photo = $this->saveFile($request->name, $request->file('photo'));
            }
            $stock_kasir=stock_kasir::create([
                
                'jumlah'=>$request->stock,
                
                
                
                ]
                
                
                
                
                );
            

            $product = Product::create([
                
                'product_stock_id'=>$stock_kasir->id,
                'code' => $request->code,
                'name' => $request->name,
                'description' => $request->description,
                'stock' => $request->stock,
                'price' => $request->price,
                'price_level1' => $request->price * 90/100,
                'price_level2' => $request->price * 70/100,
                'price_level3' => $request->price * 50/100,
                'price_level4' => $request->price * 30/100,
                'category_id' => $request->category_id,
                'photo' => $photo
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
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'code' => 'required|string|max:10|exists:products,code',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:100',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        try {
            $product = Product::findOrFail($id);
            $photo = $product->photo;

            if ($request->hasFile('photo')) {
                !empty($photo) ? File::delete(public_path('uploads/product/' . $photo)):null;
                $photo = $this->saveFile($request->name, $request->file('photo'));
            }

            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'stock' => $request->stock,
                'price' => $request->price,
                'price_level1' => $request->price * 90/100,
                'price_level2' => $request->price * 70/100,
                'price_level3' => $request->price * 50/100,
                'price_level4' => $request->price * 30/100,
                'category_id' => $request->category_id,
                'photo' => $photo
            ]);

            return redirect(route('produk.index'))
                ->with(['success' => '<strong>' . $product->name . '</strong> Diperbaharui']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }
    
     public function cari_order(Request $request)
    {
        $cari= $request->nama;
        $id=$request->categories;
       
        
           $categories = Category::orderBy('name', 'ASC')->get();
         if (!empty($request->categories)) {
         $products=  product::orderBy('id', 'DESC')->with('category')->where('category_id', $id)->paginate(1000);
        }
          if (!empty($request->nama)) {
         $products=  product::orderBy('id', 'DESC')->with('category')->where('name', $cari)->paginate(1000);
        }
            return view('request.index',  compact('products','categories'));
        
       
        
    
     
    
}
}
