<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bukti;
use File;
use DB;
use Image;
use App\Http\Resources\OrderCollection;
use Spatie\Permission\Models\Role;
use App\Exports\OrderInvoice;
use Carbon\Carbon;
use App\User;
use App\Bank;
use Cookie;
use PDF;
use App\Topup;
use Auth;
use App\anggota;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Validator;

class BuktiController extends Controller
{
    public function index()
    {
        $topup = Topup::orderBy('created_at','DSC')->paginate(10);
        $users = anggota::all();
        $bank = Bank::all();
        return view('bukti.index', ['bukti' => $topup]);
      
    }

    public function create()
    {
        return view('bukti.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'invoice' => 'required|string|max:100',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        try {
            $photo = null;
            if ($request->hasFile('photo')) {
                $photo = $this->saveFile($request->invoice, $request->file('photo'));
            }

            $bukti = Bukti::create([
                'invoice' => $request->invoice,
                'photo' => $photo
            ]);
            return redirect(route('bukti.index'))
                ->with(['success' => '<strong>' . $bukti->invoice . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }
    
    public function buktiapi(Request $request)
    {
           
            $this->validate($request, [
                'invoice' => 'required|string|max:100',
                /* 'photo' => 'nullable|image|mimes:jpg,png,jpeg' */
            ]);
            
            
    
            try {
                $photo = null;
                if ($request->hasFile('photo')) {
                    $photo = $this->saveFile($request->invoice, $request->file('photo'));
                }
                
    
                $bukti = Bukti::create([
                    'invoice' => $request->invoice,
                    'user_id' => auth()->user()->id,
                    'photo' => $photo,
                    
                ]);
                return response()->json([
                        'state' => true,
                        'message' => 'succes post data',
                        'data' => $bukti
                    ], 200);
            } catch (\Exception $e) {
                 return response()->json([
                        'state' => false,
                        'message' => 'failed post data',
                        'data' => 'mau nge hack ya ? ga bisa nerima script terlarang'
                    ], 400);
            }
         
        
    }

    private function saveFile($name, $photo)
    {
        $images = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension(). '.jpg';
        $path = public_path('uploads/bukti');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        } 
        Image::make($photo)->save($path . '/' . $images);
        return $images;
    }

    public function destroy($id)
    {
        $bukti = Topup::findOrFail($id);
        if (!empty($bukti->photo)) {
            File::delete(public_path('uploads/bukti/' . $bukti->photo));
        }
        $bukti->delete();
        return redirect()->back()->with(['success' => '<strong>' . $bukti->invoice . '</strong> Telah Dihapus!']);
    }

    public function edit($id)
    {
        $bukti = Topup::find($id);

        if(!$bukti){
            abort(404);
        }

        return view('bukti.edit')->with('bukti', $bukti);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'invoice' => 'required|string|max:100',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        try {
            $bukti = Topup::findOrFail($id);
            $userkirim = $bukti->user_id;
            $updatesaldo =  anggota::where('id' , $userkirim)->first();
            $photo = $bukti->photo;

            if ($request->hasFile('photo')) {
                !empty($photo) ? File::delete(public_path('uploads/bukti/' . $photo)):null;
                $photo = $this->saveFile($request->invoice, $request->file('photo'));
            }
            if($request->status == 2){
                $aduh = $bukti->jumlah;
                $last = strlen($aduh);
                $first = $last-3;
                $belakang = substr($aduh,$first,$last);
                $ambil = $aduh - $belakang;
                $updatesaldo =  anggota::where('id' , $userkirim)->first();
                $ceksaldo = $updatesaldo->saldo + $ambil;
                $updatesaldo->update([
                    'saldo' => $ceksaldo
                ]);

            }

            $bukti->update([
                'status' => $request->status
            ]);

            return redirect(route('bukti.index'))
                ->with(['success' => '<strong>' . $bukti->invoice . '</strong> Diperbaharui']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }
    
    
    
      public function search_bukti(Request $request)
    {
       
       
        
         if (!empty($request->invoice)) {
             $bukti=Bukti::orderBy('id', 'DESC')->with('user')->where('invoice', $request->invoice)->paginate(1000);
        }
          else if (!empty($request->nama)) {
            $bukti = Bukti::whereHas('user', function ($query) use ($request){$query->where('name', 'like', '%'.$request->nama.'%');
                
            })->with(['user' => function($query) use ($request){$query->
            where('name', 'like', '%'.$request->nama.'%');}])->paginate(1000);
        }
            return view('bukti.index',  compact('bukti'));
        
       
}
       public function topupmandiri(Request $request)
       {

            $userid = auth()->user()->id;
        

            
            $validator = Validator::make($request->all(), [
            'jumlah' => 'required|integer|min:100000',
            'no_va' => 'required|digits:16'
            ]);

            if($validator->fails()){
            return response()->json([
                        'state' => false,
                        'message' => "topup kurang dari minimum harga"
                    ], 401);
            }

            $jenis = 'MANDIRI';

            try {
    
                $bukti = Bukti::create([
                    'invoice' => $this->generateInvoiceMobile(),
                    'user_id' => auth()->user()->id,
                    'jenis_bank' => $jenis,
                    'jumlah' => $request->jumlah,
                    'no_va' => $request->no_va,
                    'status' => 1
                ]);

                $user = User::where('id', $userid)->first();
                $hasil = $user->saldo + $request->jumlah;
                $user->update([
                    'saldo' => $hasil
                ]);

                return response()->json([
                        'state' => true,
                        'message' => 'succes post data',
                        'data' => $bukti
                    ], 200);
            } catch (\Exception $e) {
                 return response()->json([
                        'state' => false,
                        'message' => 'failed post data',
                        'data' => $e
                    ], 400);
            }
       }

       public function topupbri(Request $request)
       {
           $userid = auth()->user()->id;
        

            
            $validator = Validator::make($request->all(), [
            'jumlah' => 'required|integer|min:100000',
            'no_va' => 'required|digits:16'
            ]);

            if($validator->fails()){
            return response()->json([
                        'state' => false,
                        'message' => "topup kurang dari minimum harga"
                    ], 401);
        }

            $jenis = 'BRI';

            try {
    
                $bukti = Bukti::create([
                    'invoice' => $this->generateInvoiceMobile(),
                    'user_id' => auth()->user()->id,
                    'jenis_bank' => $jenis,
                    'jumlah' => $request->jumlah,
                    'no_va' => $request->no_va,
                    'status' => 1
                ]);

                $user = User::where('id', $userid)->first();
                $hasil = $user->saldo + $request->jumlah;
                $user->update([
                    'saldo' => $hasil
                ]);

                return response()->json([
                        'state' => true,
                        'message' => 'succes post data',
                        'data' => $bukti
                    ], 200);
            } catch (\Exception $e) {
                 return response()->json([
                        'state' => false,
                        'message' => 'failed post data',
                        'data' => $e
                    ], 400);
            }
       }

       public function topupbni(Request $request)
       {
           $userid = auth()->user()->id;
        

            
            $validator = Validator::make($request->all(), [
            'jumlah' => 'required|integer|min:100000',
            'no_va' => 'required|digits:16'
            ]);

            if($validator->fails()){
            return response()->json([
                        'state' => false,
                        'message' => "topup kurang dari minimum harga"
                    ], 401);
        }

            $jenis = 'BNI';

            try {
    
                $bukti = Bukti::create([
                    'invoice' => $this->generateInvoiceMobile(),
                    'user_id' => auth()->user()->id,
                    'jenis_bank' => $jenis,
                    'jumlah' => $request->jumlah,
                    'no_va' => $request->no_va,
                    'status' => 1
                ]);

                $user = User::where('id', $userid)->first();
                $hasil = $user->saldo + $request->jumlah;
                $user->update([
                    'saldo' => $hasil
                ]);

                return response()->json([
                        'state' => true,
                        'message' => 'succes post data',
                        'data' => $bukti
                    ], 200);
            } catch (\Exception $e) {
                 return response()->json([
                        'state' => false,
                        'message' => 'failed post data',
                        'data' => $e
                    ], 400);
            }
       }

       public function generateInvoiceMobile() {
        $t=time();
        $rand = rand(1000,9999);
        return 'INV-'.$t.'-'. $rand;
    }
        
    
     
    

}
