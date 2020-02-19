<?php

namespace App\Http\Controllers;
use App\subsidi;
use Illuminate\Http\Request;

class subsidiController extends Controller
{
    
    
    
    
    public function index(){
        
        $subsidi=subsidi::paginate(10);
        
        
        
        return view('subsidi.index',compact('subsidi'));
        
        

        
        
    }
    
    
    
    public function edit($id){
        
        
        $subsidi=subsidi::where('id',$id)->first();
        
        
        return view('subsidi.edit',compact('subsidi'));
        
        
        
    }
    
    
    
    
   public function update(Request $request,$id){
       
     
       
       
       
       $this->validate($request,[
           
           'subsidi'=> 'required|numeric|min:1|max:100',          
           
           
           
           ]);
           
           
           try{
           
             $subsidi=subsidi::Where('id',$id)->first();
           
           
        $subsidi->update([
            'potongan'=>$request->subsidi,
            
            
            
            ]);
            
            return redirect(route('subsidi.index'))->with(['success' => 'subsidi: ' . $subsidi->level_bintang . ' di update']);
            
           }catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
       
   } 
    
    
    
    
    
    
    
    
    
    
}
