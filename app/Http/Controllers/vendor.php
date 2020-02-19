<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vendormodel;
class vendor extends Controller
{
    public function index(Request $request){

$count=vendormodel::count();

$vendor= vendormodel::orderby('nama','ASC')->paginate(10);

if(!empty($request->nama)){
$vendor=vendormodel::where('nama','like',"%$request->nama%")->paginate($count);

}
if(!empty($request->alamat)){

$vendor=vendormodel::where('alamat','like',"%$request->alamat%")->paginate($count);

}





return view('sub-vendor.index',compact('vendor'));





    }



    public function store(Request $request){

$vendor= vendormodel::create([
	'nama'=>$request->nama,
	'alamat'=>$request->alamat

]);



if($vendor)
return redirect()->route('vendor.index')->with(['success'=>"vendor ".$vendor->nama." berhasil di buat"]);
    }




    public function update(Request $request){


    	$vendor=vendormodel::where('id',$request->id)->first();

    	$vendor->update([
'nama'=>$request->nama,
'alamat'=>$request->alamat

    	]);


    	if($vendor){

return redirect()->route('vendor.index')->with(['success'=>"vendor ".$vendor->nama." berhasil di update"]);


    	}




    }

    public function destroy(Request $request){

$vendor=vendormodel::where('id',$request->id)->first();
$vendor->delete();
if($vendor){
return redirect()->route('vendor.index')->with(['success'=>"vendor ".$vendor->nama." berhasil di di delete"]);

}


    }
}
