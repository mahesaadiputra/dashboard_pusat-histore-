<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\berita;
use File;
use Image;
use App\content_edu;
use App\magizine;
class beritaController extends Controller
{
    public function index(){
        
    $berita = berita::orderby('created_at','DSC')->paginate(10);
    return view('berita.index', compact('berita'));
    }
    
    public function getall(){
        $berita = berita::all();
        
        if ($berita) {
                return response()->json([
                    'state' => true,
                    'message' => 'succes get data',
                    'data' => $berita
                ], 200);
            }
            return response()->json([
                'message' => 'failed get data',
                'data' => []
            ]);
    }
    
    public function detailfeed($id){
        $berita = berita::findOrFail($id);
        if ($berita) {
                return response()->json([
                    'state' => true,
                    'message' => 'succes get data',
                    'data' => $berita
                ], 200);
            }
            return response()->json([
                'message' => 'failed get data',
                'data' => []
            ]);
    }
    
    public function edit($id){
        
        $berita = berita::findOrFail($id);;
        return view('berita.edit', compact('berita'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'content' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg',
            'tampil'=>'required',
            'posisi'=>'required'
        ]);

        try {
            $berita = berita::findOrFail($id);
            $photo = $berita->photo;

            if ($request->hasFile('photo')) {
                !empty($photo) ? File::delete(public_path('uploads/berita/' . $photo)):null;
                $photo = $this->saveFile($request->name, $request->file('photo'));
            }

            $berita->update([
                'title' => $request->title,
                'content' => $request->content,
                'photo' => $photo,
                'tampil'=>$request->tampil,
                'posisi'=>$request->posisi
            ]);

            return redirect(route('berita.index'))
                ->with(['success' => '<strong>' . $berita->title . '</strong> Diperbaharui']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }
    
    
    
    public function tambah(){

    return view('berita.create');

    }
     public function store(Request $request){
        
    
  $this->validate($request, [
           
            'title' => 'required|string',
            'content' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg',
            'posisi'=>'required',
            'tampil'=>'required'
        ]);

        try {
            $photo = null;
            if ($request->hasFile('photo')) {
                $photo = $this->saveFile($request->title, $request->file('photo'));
            }
            
        
            $berita = berita::create([
                'title' => $request->title,
                'content' => $request->content,
                'photo' => $photo,
                'posisi'=>$request->posisi,
                'tampil'=>$request->tampil
            ]);
            return redirect(route('berita.index'))
                ->with(['success' => '<strong>' . $berita->title . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
        
    
        
        
        
        
        
    }
    
     private function saveFile($name, $photo)
    {
        $images = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension();
        $path = public_path('uploads/berita');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        } 
        Image::make($photo)->save($path . '/' . $images);
        return $images;
    }
    
      public function destroy($id)
    {
        $berita = berita::findOrFail($id);
        if (!empty($berita->photo)) {
            File::delete(public_path('uploads/berita/' . $berita->photo));
        }
        $berita->delete();
        return redirect()->back()->with(['success' => '<strong>' . $berita->title . '</strong> Telah Dihapus!']);
    }
    
    
    public function cari(Request $request){

        $count=berita::count();
        $berita=berita::where('title','LIKE',"%$request->nama%")->paginate($count);
        
        
        
        return view('berita.index',compact('berita'));
        
        
        
    }




    public function contentedu(Request $request){

$count=content_edu::count();
        if(!empty($request->nama)){
$konten=content_edu::where('title','LIKE',"%$request->nama%")->paginate($count);



return view('kontenedu.index',compact('konten'));

        }
$konten=content_edu::orderby('created_at','dsc')->paginate(10);

return view('kontenedu.index',compact('konten'));

    }


    public function tambahedu(){

return view('kontenedu.create');


    }


    public function editedu($id){
$konten=content_edu::where('id',$id)->first();

return view('kontenedu.edit',compact('konten'));




    }

     public function storekonten(Request $request){
        
    
  $this->validate($request, [
           
            'title' => 'required|string',
            'body' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg',
            'tampil'=>'required',
            'type' => 'required'
        ]);

 

        try {

            $photo = null;
            $nama_file = null;
            if ($request->file('file_document')) {
                $file = $request->file('file_document');
   
            // Mendapatkan Nama File
            $nama_file = $file->getClientOriginalName();
         
            // Mendapatkan Extension File
            $extension = $file->getClientOriginalExtension();
        
            // Mendapatkan Ukuran File
            $ukuran_file = $file->getSize();
         
            // Proses Upload File
            $destinationPath = 'uploads/konten';
            $file->move($destinationPath,$file->getClientOriginalName());
            }

            if ($request->hasFile('photo')) {
                $photo = $this->saveFile2($request->title, $request->file('photo'));
            }
            
        
            $konten = content_edu::create([
                'title' => $request->title,
                'body' => $request->content,
                'photo' => $photo,
                'tampil'=>$request->tampil,
                'document'=>$nama_file,
                'type' => $request->type
            ]);
            return redirect(route('konten.edu'))
                ->with(['success' => '<strong>' . $konten->title . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
        
    
        
        
        
        
        
    }

    private function saveFile2($name, $photo)
    {
        $images = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension();
        $path = public_path('uploads/konten');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        } 
        Image::make($photo)->save($path . '/' . $images);
        return $images;
    }



    public function hapusedu($id){

$konten=content_edu::where('id',$id)->first();
$konten->delete();



 return redirect()->back()->with(['success' => '<strong>' . $konten->title . '</strong> Telah Dihapus!']);
    }





    public function updateedu(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'content' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg',
            'tampil'=>'required',
            'type' => 'required'
        ]);

        try {
            $berita = content_edu::findOrFail($id);
            $photo = $berita->photo;

            if ($request->hasFile('photo')) {
                !empty($photo) ? File::delete(public_path('uploads/konten/' . $photo)):null;
                $photo = $this->saveFile2($request->name, $request->file('photo'));
            }

            $berita->update([
                'title' => $request->title,
                'body' => $request->content,
                'photo' => $photo,
                'tampil'=>$request->tampil,
                'type' => $request->type,
            ]);

            return redirect(route('konten.edu'))
                ->with(['success' => '<strong>' . $berita->title . '</strong> Diperbaharui']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }


    // -------------- magizine 

    public function contentmag(Request $request){

        $count=magizine::count();
                if(!empty($request->nama)){
        $konten=magizine::where('title','LIKE',"%$request->nama%")->paginate($count);
        
        
        
        return view('magizine.index',compact('konten'));
        
                }
        $konten=magizine::orderby('created_at','dsc')->paginate(10);
        
        return view('magizine.index',compact('konten'));
        
            }
        
        
            public function tambahmag(){
        
        return view('magizine.create');
        
        
            }
        
        
            public function editmag($id){
        $konten=magizine::where('id',$id)->first();
        
        return view('magizine.edit',compact('konten'));
        
        
        
        
            }
        
             public function storekontenmag(Request $request){
                
            
          $this->validate($request, [
                   
                    'title' => 'required|string',
                    'content' => 'required|string',
                    'posisi' => 'required|string',
                    'photo' => 'nullable|image|mimes:jpg,png,jpeg',
                    'tampil'=>'required',
                    
                ]);
        
         
        
                try {
        
                    $photo = null;
        
                    if ($request->hasFile('photo')) {
                        $photo = $this->saveFile3($request->title, $request->file('photo'));
                    }
                    
                
                    $konten = magizine::create([
                        'title' => $request->title,
                        'content' => $request->content,
                        'photo' => $photo,
                        'posisi'=>$request->posisi,
                        'tampil' => $request->tampil
                    ]);
                    return redirect(route('konten.mag'))
                        ->with(['success' => '<strong>' . $konten->title . '</strong> Ditambahkan']);
                } catch (\Exception $e) {
                    return redirect()->back()
                        ->with(['error' => $e->getMessage()]);
                }
                
            
                
                
                
                
                
            }
        
            private function saveFile3($name, $photo)
            {
                $images = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension();
                $path = public_path('uploads/mag');
        
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0777, true, true);
                } 
                Image::make($photo)->save($path . '/' . $images);
                return $images;
            }
        
        
        
            public function hapusmag($id){
        
        $konten=magizine::where('id',$id)->first();
        $konten->delete();
        
        
        
         return redirect()->back()->with(['success' => '<strong>' . $konten->title . '</strong> Telah Dihapus!']);
            }
        
        
        
        
        
            public function updatemag(Request $request, $id)
            {
                $this->validate($request, [
                    'title' => 'required|string',
                    'content' => 'required|string',
                    'posisi' => 'required|string',
                    'photo' => 'nullable|image|mimes:jpg,png,jpeg',
                    'tampil'=>'required',
                ]);
        
                try {
                    $berita = magizine::findOrFail($id);
                    $photo = $berita->photo;
        
                    if ($request->hasFile('photo')) {
                        !empty($photo) ? File::delete(public_path('uploads/mag/' . $photo)):null;
                        $photo = $this->saveFile2($request->name, $request->file('photo'));
                    }
        
                    $berita->update([
                        'title' => $request->title,
                        'content' => $request->content,
                        'photo' => $photo,
                        'posisi'=>$request->posisi,
                        'tampil' => $request->tampil
                    ]);
        
                    return redirect(route('konten.mag'))
                        ->with(['success' => '<strong>' . $berita->title . '</strong> Diperbaharui']);
                } catch (\Exception $e) {
                    return redirect()->back()
                        ->with(['error' => $e->getMessage()]);
                }
            }

    }





