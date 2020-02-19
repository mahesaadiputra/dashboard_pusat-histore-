<?php

namespace App\Http\Controllers;
use App\pre_order;
use Carbon\Carbon;
use App\vendormodel;
use App\User;
use App\Product;
use App\stocktable;
use App\stock_histore;
use App\user_histore;
use Auth;

use Illuminate\Http\Request;

class pre_ordercontroller extends Controller
{
   
public function index(Request $req){

	$count=pre_order::count();
	$pre_order=pre_order::orderby('tgl_kirim','dsc')->paginate(10);
	$vendor=vendormodel::orderby('nama','asc')->get();

/*$user=user::select([
'login_admin.id',
'login_admin.name',
'login_admin.alamat',
'model_has_roles.role_id',
'roles.name as role'

					])
					->join('model_has_roles','model_id','=','login_admin.id')
					->join('roles','roles.id','=','model_has_roles.role_id')
					->where('roles.name','admin')
					->get();*/


$user=user_histore::orderby('name','ASC')->get();

					$product=Product::orderby('name','ASC')->where('itki',"tidak")->get();
if(!empty($req->nama)){

	$pre_order=pre_order::where('vendor','like',"%$req->nama%")->paginate($count);
						}
if(!empty($req->product)){

	$pre_order=pre_order::where('nama_product','like',"%$req->product%")->paginate($count);
						}
if(!empty($req->resi)){

	$pre_order=pre_order::where('resi','like',"%$req->resi%")->paginate($count);
						}
if(!empty($req->status)){

	$pre_order=pre_order::where('status',$req->status)->paginate($count);
						}


								return view('pre_order.index',compact('pre_order','vendor','product','user'));




}

public function store(Request $req){

$product=Product::where('id',$req->product)->first();

$pre_order=pre_order::create([
'vendor'=>$req->vendor,
'nama_product'=>$product->name,
'qty'=>$req->qty,
'status'=>1,
'harga'=>$req->harga,
'resi'=>$req->resi,
'alamat_kirim'=>$req->alamat,
'tgl_kirim'=>Carbon::now()

]);

if($pre_order){

return redirect()->route('pre_order.index')->with(['success'=>"pre order berhasil di buat"]);


				}






								}


public function destroy(Request $req){

$pre_order=pre_order::where('id',$req->id)->first();

$pre_order->delete();

if($pre_order){

return redirect()->route('pre_order.index')->with(['success'=>"pre order berhasil di hapus"]);


}


}


public function proses(Request $req){

$id=Auth::user()->id;
	$pre_order=pre_order::where('id',$req->id)->first();
	$product=Product::where('name',$req->nama)->first();
	if($req->status == "2"){

$pre_order->update([
'status'=>$req->status,
'tgl_terima'=>Carbon::now()




]);
$user=user_histore::where('alamat',$req->alamat)->first();

$scan=stock_histore::where('user_id',$user->id)->where('product_id',$product->id)->first();

if($scan){

$scan->update([
'stock'=>$req->qty

]);


}

if(!$scan){

$stock=stock_histore::create([
'product_id'=>$product->id,
'user_id'=>$user->id,
'stock'=>$req->qty


	]);

}

/*if($user){
	$userrole=user::select([
'login_admin.id',
'login_admin.name',
'login_admin.alamat',
'model_has_roles.role_id',
'roles.name as role'

])
->join('model_has_roles','model_id','=','login_admin.id')
->join('roles','roles.id','=','model_has_roles.role_id')
->where('login_admin.id',$user->id)
->get();*/


	



}

return redirect()->route('pre_order.index')->with(['success'=>"pre order berhasil di proses"]);
	}

}




