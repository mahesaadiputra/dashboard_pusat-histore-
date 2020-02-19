<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Customer;
use App\anggota;
use App\Order;
use App\User;
use App\Notifikasi;
use Auth;
use Session;
use otp;
use Carbon\Carbon;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\File;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

public function otp(Request $req){
if(Session::get('verify') ==  true){

return redirect()->back();

}

    return view('otp');

}


public function verifyotp(Request $req){



if($req->otpCode == Session::get('otpkode')){
    $user=User::where('id',Auth::user()->id)->first();
    /*$user->update([
        'status_login'=>1
    ]);*/
Session::put(['verify'=>true]);
$waktu= Carbon::now();
$pesan = new otp;
$name=Auth::user()->name; 
$ip=\Request::ip();
$browse=\Request::header('User-Agent');
$message= "Data login Dashboard Histore \n
nama : ".$name."\n
ip : ".$ip."\n
waktu :".$waktu."\n
Os dan Browser : ".$browse
; 
$pesan->sendMessageVia('-357515043', $message,'Web Dashboard');





return redirect()->route('home');

}

if($req->otpCode != Session::get('otpkode') ){
return redirect()->back()->with(['error'=>"otp salah "]);

}





}


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    private function objData(){
        $data = (object)array();
        $data->state = false;
        $data->msg = "Failed";
        $data->code = 105;
        $data->http = 0;
        $data->data = [];
        return $data;
    }

    public function getClient($data){
        $client = new Client();
        try{
            $result = $client->get($data['url'], [
                'headers' => [
                    'Content-Type' => 'application/json'
                ],
            ]);
            $response = $result->getBody()->getContents();
            $decode = json_decode($response);
            if(isset($decode->error)){
                throw $err;
            }
            $data = $this->objData();
            $data->data = $decode;
            $data->msg = 'Success';
            $data->state = !false;
            $data->http = 200;
            $data->code = 100;
            return $data;
        }catch(\Exception $err){
            $error = $this->objData();
            $error->msg = "Failed to Fetch Data";
            $error->http = $err->getCode();
            return $error;
        }
    }
    public function index(){
            $product = Product::count();
            $order = Order::count();
            $customer = anggota::count();
            $user = anggota::count();
                $ordernotif = Order::where('status','0')->count();
            return view('home', compact('product', 'order', 'customer', 'user','ordernotif'));
        }
    public function Subscribe($token){
        $userid = Auth::user()->userid;
        $url = 'http://ipehapp.intek.id:5000/notifikasi/subscribe/'.$token.'/'.$userid;
        $data['url'] = $url;
        $response = $this->getClient($data);
        return response()->json($response);
    }

    public function logout($token){
        $userid = Auth::user()->userid;
        $url = 'http://ipehapp.intek.id:5000/notifikasi/unsubscribe/'.$token.'/'.$userid;
        $data['url'] = $url;
        $response = $this->getClient($data);
        return redirect()->to('logout');
        // return response()->json($response);
    }

    public function getNotification(){
        $userid = Auth::user()->userid;
        // dd($userid);
        $notif = new Notifikasi();
        $notif = $notif->where(['to' => $userid, 'opened' => 0])->get();
        // dd($notif);
        return response()->json($notif);
    }
}
