<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use File;
use Image;

class BannerController extends Controller
{
    public function index(){
        
        $banner = Banner::orderby('created_at','DSC')->paginate(10);
        return view('banner.index', compact('banner'));
        }
        
        public function getall(){
            $banner = Banner::all();
            
            if ($banner) {
                    return response()->json([
                        'state' => true,
                        'message' => 'succes get data',
                        'data' => $banner
                    ], 200);
                }
                return response()->json([
                    'message' => 'failed get data',
                    'data' => []
                ]);
        }
        
        public function detailfeed($id){
            $banner = Banner::findOrFail($id);
            if ($banner) {
                    return response()->json([
                        'state' => true,
                        'message' => 'succes get data',
                        'data' => $banner
                    ], 200);
                }
                return response()->json([
                    'message' => 'failed get data',
                    'data' => []
                ]);
        }
        
        public function edit($id){
            
            $banner = Banner::findOrFail($id);;
            return view('banner.edit', compact('banner'));
        }
        public function update(Request $request, $id)
        {
            $this->validate($request, [
                'title' => 'required|string|',
                'content' => 'nullable|string|max:100',
                'photo' => 'nullable|image|mimes:jpg,png,jpeg'
            ]);
    
            try {
                $banner = Banner::findOrFail($id);
                $photo = $banner->photo;
    
                if ($request->hasFile('photo')) {
                    !empty($photo) ? File::delete(public_path('uploads/banner/' . $photo)):null;
                    $photo = $this->saveFile($request->name, $request->file('photo'));
                }
    
                $banner->update([
                    'title' => $request->title,
                    'content' => $request->content,
                    'photo' => $photo
                ]);
    
                return redirect(route('banner.index'))
                    ->with(['success' => '<strong>' . $banner->title . '</strong> Diperbaharui']);
            } catch (\Exception $e) {
                return redirect()->back()
                    ->with(['error' => $e->getMessage()]);
            }
        }
        
        
        
        public function tambah(){
    
        return view('banner.create');
    
        }
         public function store(Request $request){
            
        
            $this->validate($request, [
               
                'title' => 'required|string|max:100',
                'content' => 'nullable|string|max:100',
                'photo' => 'nullable|image|mimes:jpg,png,jpeg'
            ]);
    
            try {
                $photo = null;
                if ($request->hasFile('photo')) {
                    $photo = $this->saveFile($request->title, $request->file('photo'));
                }
                
            
                $banner = Banner::create([
                    'title' => $request->title,
                    'content' => $request->content,
                    'photo' => $photo
                ]);
                return redirect(route('banner.index'))
                    ->with(['success' => '<strong>' . $banner->title . '</strong> Ditambahkan']);
            } catch (\Exception $e) {
                return redirect()->back()
                    ->with(['error' => $e->getMessage()]);
            }
            
        
            
            
            
            
            
        }
        
         private function saveFile($name, $photo)
        {
            $images = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension();
            $path = public_path('uploads/banner');
    
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            } 
            Image::make($photo)->save($path . '/' . $images);
            return $images;
        }
        
          public function destroy($id)
        {
            $banner = Banner::findOrFail($id);
            if (!empty($banner->photo)) {
                File::delete(public_path('uploads/banner/' . $banner->photo));
            }
            $banner->delete();
            return redirect()->back()->with(['success' => '<strong>' . $banner->title . '</strong> Telah Dihapus!']);
        }
        
        
        public function cari(Request $request){


            $banner=Banner::count();
            $banner=Banner::where('title','LIKE',"%$request->nama%")->paginate($banner);
            
            
            
            return view('banner.index',compact('banner'));
            
            
            
        }
}
