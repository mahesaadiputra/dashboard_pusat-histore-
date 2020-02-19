<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Auth;
use App\User;
use App\Kota;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::orderBy('id', 'DESC')->paginate(10);
        

        return view('customer.index', ['customer' => $customer]);
    }

    public function getCustomerlist()
    {
        return Customer::all();
    }
    
    public function detailalamat($idih){
        
        $detailalamat = 
              Customer::select(
                  'customers.id',
                  'panggilan_alamat',
                  'email',
                  'users_id',
                  'kota_id',
                  'kotas.city_name as city_name',
                  'name',
                  'address',
                  'phone',
                  'created_at',
                  'updated_at')
                  ->join('kotas','customers.kota_id','=','kotas.city_id')
                  ->find($idih);
        
        
            if ($detailalamat) {
                return response()->json([
                    'state' => true,
                    'message' => 'succes get data',
                    'alamat' => $detailalamat
                ], 200);
            }
            return response()->json([
                'message' => 'failed get data',
                'data' => []
            ]);

            
            
    }
    
    public function editalamat(Request $request,$ngedit){

        $this->validate($request, [
            'address' => 'required',
            'phone' => 'required',
        ]);
    
        $maafinaku = Customer::find($ngedit);
        
        $email = !empty($request->email)?($request->email):$maafinaku->email;
        $name = !empty($request->name)?($request->name):$maafinaku->name;
        $panggilan_alamat = !empty($request->panggilan_alamat)?($request->panggilan_alamat):$maafinaku->panggilan_alamat;
        $users_id = !empty($request->users_id)?($request->users_id):$maafinaku->users_id;
        
        $maafinaku->update([
                'email' => $email,
                'name' => $name,
                'panggilan_alamat' => $panggilan_alamat,
                'users_id' => $users_id,
                'address' => $request->address,
                'phone' => $request->phone,
        ]);
        if ($maafinaku) {
                return response()->json([
                    'state' => true,
                    'message' => 'succes edit data',
                ], 200);
            }
            return response()->json([
                'message' => 'failed edit data',
            ]);
    }
    
    public function liatalamat($ids){
        
        $ids = auth()->user()->id;
        $melihat = Customer::select(
                  'customers.id',
                  'panggilan_alamat',
                  'email',
                  'users_id',
                  'kota_id',
                  'kotas.city_name as city_name',
                  'name',
                  'address',
                  'phone',
                  'created_at',
                  'updated_at')
                  ->join('kotas','customers.kota_id','=','kotas.city_id')
                  ->where('users_id', $ids)->get();
        
            if ($melihat) {
                return response()->json([
                    'state' => true,
                    'message' => 'succes get data',
                    'data' => $melihat
                ], 200);
            }
            return response()->json([
                'message' => 'failed get data',
                'data' => []
            ]);

            
            
    }
    
    public function namakota(){
        $list_kota = Kota::all();
        return response()->json([
            'data' => $list_kota
        ],200);
    }
     
    
    public function daftaralamat(Request $request)
    {
        

        $this->validate($request, [
            'address' => 'required',
            'phone' => 'required',
            'panggilan_alamat' => 'required'
        ]);

      
            $customer = Customer::firstOrCreate([
                'email' => auth()->user()->email,
                'name' => auth()->user()->name,
                'panggilan_alamat' => $request->panggilan_alamat,
                'kota_id' => $request->kota_id,
                'users_id' => auth()->user()->id,
                'address' => $request->address,
                'phone' => $request->phone,
            ]);
            
            return response()->json([
                'message' => 'succes register address',
                'data' =>  $customer
                ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('customer.create');
        
   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

      
            $customer = Customer::create([
                'email' => $request->email,
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
            ]);
            return redirect(route('customer.index'))
                ->with(['success' => '<strong>' . $customer->name . '</strong> Ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);

        if(!$customer){
            abort(404);
        }

        return view('customer.single')->with('customer', $customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);

        if(!$customer){
            abort(404);
        }

        return view('customer.edit')->with('customer', $customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'email'   => 'required',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

            // Validate the request...

        try {
            $customer = Customer::findOrFail($id);
            $customer->update([
                'email' => $request->email,
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
            ]);
            return redirect(route('customer.index'))->with(['success' => 'Customer: ' . $customer->name . ' Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect('customer')->with('message', 'halaman sudah di hapus !');
    }


    public function search(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);

        $customer = Customer::where('email', $request->email)->first();
        if ($customer) {
            return response()->json([
                'state' => true,
                'status' => 'success',
                'data' => $customer
            ], 200);
        }
        return response()->json([
            'status' => 'failed',
            'data' => []
        ]);
    }
    
    
    
    
    public function search_nama(Request $request)
    {
        $cari= $request->nama;
        $email=$request->email;
        $count=Customer::count();
        
        
         if (!empty($request->nama)) {
             $customer= Customer::orderBy('created_at', 'DESC')->where('name','LIKE', "%$cari%")->paginate($count);
              return view('customer.index',  compact('customer'));
        }
          if (!empty($request->email)) {
             $customer= Customer::orderBy('created_at', 'DESC')->where('email', 'LIKE',"%$email%")->paginate($count);
              return view('customer.index',  compact('customer'));
        }
         if (!empty($request->alamat)) {
            $customer= Customer::orderBy('created_at', 'DESC')->where('address','LIKE', "%$request->alamat%")->paginate($count);
             return view('customer.index',  compact('customer'));
        }
        
          if (!empty($request->telepon)) {
            $customer= Customer::orderBy('created_at', 'DESC')->where('phone','LIKE', "%$request->telepon%")->paginate($count);
             return view('customer.index',  compact('customer'));
        }
           
        
       
        
    
     
    
}

}
