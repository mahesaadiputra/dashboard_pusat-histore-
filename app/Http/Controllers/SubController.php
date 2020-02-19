<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Sub_Category;
use App\Category;

class SubController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $sub_categories = Sub_Category::orderBy('sub_nama', 'ASC')->paginate(10);
        return view('categories.sub.index', compact('categories','sub_categories'));
    }
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'sub_nama' => 'required|string|max:50',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        try {
            $sub_categories = Sub_Category::create([
                'sub_nama' => $request->sub_nama,
                'description' => $request->description,
                'category_id' => $request->category_id,
                
            ]);
            return redirect()->back()->with(['success' => 'Kategori: ' . $sub_categories->sub_nama . ' Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
        
        
        
    }
    
    public function destroy($id)
    {
        $sub_categories = Sub_Category::findOrFail($id);
        $sub_categories->delete();
        return redirect()->back()->with(['success' => 'Kategori: ' . $sub_categories->sub_nama . ' Telah Dihapus']);
    }

    public function edit($id)
    {
        
        $categories = Category::orderBy('name', 'ASC')->get();
        $sub_categories = Sub_Category::findOrFail($id);
        return view('categories.sub.edit', compact('categories','sub_categories'));
    }

    public function update(Request $request, $id)
    {
        //validasi form
        $this->validate($request, [
            'sub_nama' => 'required|string|max:50',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        try {
            $sub_categories = Sub_Category::findOrFail($id);
            $sub_categories->update([
                'sub_nama' => $request->sub_nama,
                'description' => $request->description,
                'category_id' => $request->category_id,
            ]);
            return redirect(route('sub.index'))->with(['success' => 'Kategori: ' . $sub_categories->sub_nama . ' Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }




    public function carisub(Request $request){



        $count=Sub_category::count();
        $categories = Category::orderBy('name', 'ASC')->get();
        $sub_categories=Sub_category::where('sub_nama','LIKE',"%$request->nama%")->paginate($count);
        return view('categories.sub.index', compact('categories','sub_categories'));










    }
    
    
}
