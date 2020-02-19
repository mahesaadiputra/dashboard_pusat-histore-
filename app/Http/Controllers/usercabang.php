<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user_cabang;
use Hash;

class usercabang extends Controller
{
    public function index(Request $request){

if(!empty($request->nama)){

	$jumlah=user_cabang::count();
$users=user_cabang::where('name','LIKE',"%$request->nama%")->paginate($jumlah);
return view('usercabang.index',compact('users'));


}
if(!empty($request->email)){

	$jumlah=user_cabang::count();
$users=user_cabang::where('email','LIKE',"%$request->email%")->paginate($jumlah);
return view('usercabang.index',compact('users'));


}

if(!empty($request->status)){
if($request->status == 2){

$status = 0;

}elseif($request->status == 1){



	$status =1;
}
$jumlah=user_cabang::count();

$users=user_cabang::where('status',$status)->paginate($jumlah);


return view('usercabang.index',compact('users'));



}


	$users=user_cabang::orderby('name','ASC')->paginate(10);
	return view('usercabang.index',compact('users'));

    }



    public function tambah(){


    	return view('usercabang.create');


    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:anggota',
            'password' => 'required|min:6',
            'role'=>'required',
            'alamat'=>'required'
           
          

        ]);

        $user = user_cabang::firstOrCreate([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request['password']),
            'alamat'=>$request->alamat,
            'role'=>$request->role,  
            'status' => true
        ]);

      
        return redirect(route('users.cabang'))->with(['success' => 'User: <strong>' . $user->name . '</strong> Ditambahkan']);
    }



    public function edit($id){

$user=user_cabang::where('id',$id)->first();
 return view('usercabang.edit', compact('user'));







    }



    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
        ]);

        $user = user_cabang::findOrFail($id);
        $password = !empty($request->password) ? bcrypt($request->password):$user->password;
        $user->update([
            'email'=>$request->email,
            'name' => $request->name,
            'password' => $password,
            'status'=>$request->status,
            'alamat'=>$request->alamat,
            'role'=>$request->role
        ]);
        return redirect(route('users.cabang'))->with(['success' => 'User: <strong>' . $user->name . '</strong> Diperbaharui']);
    }

    public function destroy($id)
    {
        $user = user_cabang::findOrFail($id);
        $user->delete();
        return redirect()->back()->with(['success' => 'User: <strong>' . $user->name . '</strong> Dihapus']);
    }
}
