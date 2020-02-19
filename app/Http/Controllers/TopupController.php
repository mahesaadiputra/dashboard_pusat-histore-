<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topup;
use Auth;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use File;
use DB;
use Image;
use Carbon\Carbon;
use Validator;


class TopupController extends Controller
{

	public function belee(Request $request)
    {
           

            $validator = Validator::make($request->all(), [
            'jumlah' => 'required|integer|min:100000',
            ]);

            if($validator->fails()){
            return response()->json([
                        'state' => false,
                        'message' => "topup kurang dari minimum harga"
                    ], 401);
        }
            
            
    
            try {
                $photo = null;
                if ($request->hasFile('photo')) {
                    $photo = $this->saveFile($request->invoice, $request->file('photo'));
                }
                
    
                $topup = Topup::create([
                    'invoice' => $this->generateInvoiceMobile(),
                    'user_id' => auth()->user()->id,
                    'bank_id' => $request->bank_id,
                    'jumlah' => substr($request->jumlah,0,-3). rand(100,999),
                    'status' => 1,
                    'photo' => $photo
                    
                ]);
                return response()->json([
                        'state' => true,
                        'message' => 'succes post data',
                        'data' => $topup
                    ], 200);
            } catch (\Exception $e) {
                 return response()->json([
                        'state' => false,
                        'message' => 'failed post data',
                        'data' => 'mau nge hack ya ? ga bisa nerima script terlarang'
                    ], 401);
            }
         
        
    }
    public function generateInvoiceMobile() {
        $t=time();
        $rand = rand(1000,9999);
        return 'INV-'.$t.'-'. $rand;
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
}
