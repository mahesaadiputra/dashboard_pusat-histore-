<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use DB;
use File;
use Image;
use Validator;
use App\email;
use App\voucher;
use App\Kota;
use JWTAuth;
use App\stock_level;
use Auth;
use App\Otp;
use App\Customer;
use GuzzleHttp\Client;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Input;
use Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use PDF;


class UserController extends Controller
{
    
    
    public function mail(Request $request){
        
        $userid = auth()->user()->id;
        $email = $request->email;
        $name = auth()->user()->name;
        $stat = 0 ;
        $to_name = $name;
        $to_email = $email;
        $rand = rand(100000,999999);
        
        $user = User::where('id', $userid)->first();
        
        $user->update([
                'email' => $email
                ]);
                
        Otp::create([
                'otp' => $rand,
                'status' => $stat,
                'user_id' => $userid
            ]);
            
        $data = array('nama'=> $name,
                       'otp'=> $rand 
        );
        
        Mail::send('mail', $data, function($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)
        ->subject('Kode OTP');
        $message->from('noreply@histore.id','Mitra Histore');
            $header=$message->getSwiftMessage();
            $kepala=$header->getHeaders();
            $kepala->addTextHeader('x-mailgun-native-send', 'true');
        
        
        
        });
        
        return response()->json([
                        'state' => true,
                        'message' => 'Email Was Sent to '.$to_email. ' Bila tidak ada di inbox bisa check folder spam',
                    ], 200);

    
    }
    
    public function otpfungsi(Request $request){
        
        $userid = auth()->user()->id;
        
        
        $otp = Otp::where('otp',$request->otp)->where('user_id', $userid)->first();
        $user = User::where('id', $userid)->first();
        $to_email=$user->email;
        $to_name=$user->name;
        
      $usermitra=$user->mitra_id;
      
    
        
        $hpsensor=$user->hp_mitra;
           $sendhp=substr($hpsensor,0,2).'********'.substr($hpsensor,-4);
        
            
        
     
      
        if($otp != null && $otp->status == 0 && $request->otp == $otp->otp ){
            

            $data = array('nama'=> $user->name,
                       'mitra_id'=> $user->mitra_id,
                       'alamat'=> $user->alamat,
                       'hp'=>$sendhp
        );
        
   
        
        Mail::send('data', $data, function($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)
        ->subject(' selamat anda berhasil menjadi mitra !!');
        $message->from('noreply@histore.id','Mitra Histore');
            $header=$message->getSwiftMessage();
            $kepala=$header->getHeaders();
            $kepala->addTextHeader('x-mailgun-native-send', 'true');
        
        
        });
               
            
            
            $otp->update([
                'status' => 1
                ]);
            $user->update([
                'status_mitra' => 1,
                'status'=> 1,
                ]);
              return response()->json([
                    'state' => true,
                    'message' => 'success',
                    'data' => $otp
                ], 200);
                
                
                
                       
     
            
        }
        
        else{
            
             return response()->json([
                 'state' =>false,
                'message' => 'salah otp kamu',
            ],401);
            
            
        }
    }
    
    public function daftarmitra(Request $request){
           
        $lempar = [
            'userid' => $request->userid,
            'hp' => $request->hp,
        ];    
        
        $user = user::select('*', 'status_mitra as status')->where('userid' , $request->userid)->where('hp', $request->hp)->first();
       

        
        if ($user != null){
            $karir = $user->karir;
             $stat = $user->status;
            if($karir == 'user' || $karir == 'Bintang 0'){
                    return response()->json([
                    'state' => false,
                    'message' => 'anda bukan anggota histore atau anda bukan bintang 1 sampe 4',
                ], 200);
                }else if($karir == 'Bintang 1' || $karir == 'Bintang 2' || $karir == 'Bintang 3' || $karir == 'Bintang 4'){

            $token = JWTAuth::fromUser($user);
                
            $data_body['user'] = $user;
            $data_body['token'] = $token;
                
            $response_client['state'] = true;
            $response_client['data'] = $data_body;
            $response_client['message'] = 'Data valid';
            $response_client['status'] = $user->status_mitra;
                
            return $response_client;
                }
        
    }
                
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'http://ipehapp.intek.id/histore/user.php?userid='.$request->userid);
        $data = $response->getBody();
        
        
        $json = json_decode($data, true);
        
        if($json['success'] == '1'){
            $message = $json['message'];
            
            $hp = $message[0]['hp'];
            
            if($hp == $request->hp){
                
                
                $dt = Carbon::now()->format('y-md');
                $tanggal= $dt;
               
                $name = $message[0]['nama'];
                $karir = $message[0]['karir'];
                $hp = $message[0]['hp'];
                $kota = $message[0]['kota'];
                $provinsi = $message[0]['provinsi'];
                $email = $message[0]['email'];
                $ktp = $message[0]['ktp'];
                
                if($karir == 'user' || $karir == 'Bintang 0'){
                    return response()->json([
                    'state' => false,
                    'message' => 'anda bukan anggota histore atau anda bukan bintang 1 sampe 4',
                ], 200);
                }else if($karir == 'Bintang 1' || $karir == 'Bintang 2' || $karir == 'Bintang 3' || $karir == 'Bintang 4'){

                if($karir == 'Bintang 0'){
                    $role = "user";
                }else if($karir == 'Bintang 1'){
                    $mitra=substr($hp, -4);
                    
                    $format='M'.$tanggal.$mitra;
                  
                    
                    $role = "level1";
                }else if($karir == 'Bintang 2'){
                    
                     $mitra=substr($hp, -4);
                    
                    $format='S'.$tanggal.$mitra;
                  
                    $role = "level2";
                }else if($karir == 'Bintang 3'){
                    
                       $mitra=substr($hp, -4);
                    
                    $format='G'.$tanggal.$mitra;
                  
                    $role = "level3";
                }else if($karir == 'Bintang 4'){
                    $role = "level4";
                       $mitra=substr($hp, -4);
                    
                    $format='P'.$tanggal.$mitra;
                  
                }
                
                    
    
                $user = user::where('userid' , $request->userid)->first();
               
                
                if($user == null) {
                    $user = User::create([
                        'name' => $name,
                        'email' => $email,
                        'karir' => $karir,
                        'userid' => $request->userid,
                        'hp' => $hp,
                        'mitra_id'=>$format,
                        'kota' => $kota,
                        'provinsi' => $provinsi,
                        'ktp' => $ktp,
                        'status' => 0,
                        'status_mitra' => 0
                        
                    ]);
                    $user->assignRole($role);
                    
                    
                    $token = JWTAuth::fromUser($user);
            
                    // return response()->json(compact('user','token'),201);
                    
                    $data_body['user'] = $user;
                    $data_body['token'] = $token;
                    
                    $response_client['state'] = true;
                    $response_client['data'] = $data_body;
                    $response_client['message'] = 'Data valid';
                    $response_client['status'] = $user->status_mitra;
                    
                    
                    return $response_client;
                }
                
                
                
                $token = JWTAuth::fromUser($user);
                
                $data_body['user'] = $user;
                $data_body['token'] = $token;
                
                $response_client['state'] = true;
                $response_client['data'] = $data_body;
                $response_client['message'] = 'Data valid';
                $response_client['status'] = $stat;
                
                return $response_client;
                
                }
                
            }else{
                $response_client['state'] = false;
                $response_client['data'] = null;
                $response_client['message'] = 'Data not found';
            }
        }else{
            $response_client['state'] = false;
            $response_client['data'] = null;
            $response_client['message'] = 'Data not found';
        }
        
        
        return $response_client;
        
       
    }
    
    public function editmitra(Request $request)
    {
        $ids = auth()->user()->id;
        
    
         try {
                $photo = null;
                if ($request->hasFile('photo')) {
                    $photo = $this->saveFile($ids, $request->file('photo'));
                }
                $photo2 = null;
                if ($request->hasFile('photo_ktp')) {
                    $photo2 = $this->saveFile2($ids, $request->file('photo_ktp'));
                }

                $user = User::select('*', 'status_mitra as status')->where('id',$ids)->first();
                $cname = null;
                
                    
                $name = !empty($request->name)?($request->name):$user->name;
                $password = !empty($request->password) ? bcrypt($request->password):$user->password;
                $status = !empty($request->status)?($request->status):$user->status;
                $photo = !empty($request->photo)?($photo):$user->photo;
                $photo2 = !empty($request->photo_ktp)?($photo2):$user->photo_ktp;
                $jenis = !empty($request->jenis_bank)?($request->jenis_bank):$user->jenis_bank;
                $email = !empty($request->email)?($request->email):$user->email;
                $hp_mitra = !empty($request->hp_mitra)?($request->hp_mitra):$user->hp_mitra;
                $kota = !empty($request->kota_id)?($request->kota_id):$user->kota_id;
                $no_rek = !empty($request->no_rek)?($request->no_rek):$user->no_rek;
                $alamat = !empty($request->alamat)?($request->alamat):$user->alamat;
                $ing = !empty($request->ing)?($request->ing):$user->ing;
                $ltd = !empty($request->ltd)?($request->ltd):$user->ltd;
                if (!empty($user->kota_id)){
                    $id_kota =  $user->kota_id;
                
                $citay = Kota::where('city_id', $id_kota)->first();
                $cname = $citay->city_name;
                }
                
                
                $user->update([
                    'name' => $name,
                    // 'status' => $status,
                    'photo' => $photo,
                    'kota' => $cname,
                    'kota_id' => $kota,
                    'password' => $password,
                    'ing' => $ing,
                    'lat' => $ltd,
                    'jenis_bank' => $jenis,
                    'no_rek' => $no_rek,
                    'alamat' => $alamat,
                    'email' => $email,
                    'photo_ktp' => $photo2,
                    'hp_mitra' => $hp_mitra
                ]);

                return response()->json([
                        'state' => true,
                        'message' => 'succes post data',
                        'data' => $user,
                    ], 200);
                    
                
                    
                
            } catch (\Exception $e) {
                // return 'mau nge hack ya ? ga bisa nerima script terlarang '.$e->getMessage();
                 return response()->json([
                        'state' => false,
                        'message' => $e->getMessage(),
                        'data' => 'mau nge hack ya ? ga bisa nerima script terlarang '.$e->getMessage()
                    ], 400);
            }
        
        
    }
    
    private function saveFile2($name, $photo2)
    {
        $images = str_slug($name) . time() . '.' . $photo2->getClientOriginalExtension();
        $path = public_path('uploads/ktp');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        } 
        Image::make($photo2)->save($path . '/' . $images);
        return $images;
    }
    
 
    public function cekjson(){
        
        $cek = auth()->user()->userid;
        
        $ceko =  user::where('userid',$cek)->first();
        
        $useridce = $ceko['karir'];
        
        
        
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'http://ipehapp.intek.id/histore/level3.php?userid='.$cek);
        $data = $response->getBody();
        
        $wek = json_decode($data, true);
        $hasil = $wek['jaringan'];
        
        return $hasil;
       
       
        // $voc = 65756456;
        // $pot  = 1;
        // $vocer = voucher::where('kode_voucher', $voc)->first();
        // $ids = $vocer->id;
        // $cot = $vocer->pemakaian;
        
        // $itungpoin = $cot - $pot;
        //   $hasil =  voucher::where('id', $ids)->update([
        //         'pemakaian' => $itungpoin,
        //     ]);
        // return $vocer;
   
        
    }
    
    public function uploadpoto(Request $request){
        $ids = auth()->user()->id;
         try {
                $photo = null;
                if ($request->hasFile('photo')) {
                    $photo = $this->saveFile($ids, $request->file('photo'));
                }

                $user = User::findOrFail($ids);
                $password = !empty($request->password) ? bcrypt($request->password):$user->password;
                 $email = !empty($request->email)?($request->email):$user->email;
                $user->update([
                    'name' => $request->name,
                    'status' => $request->status,
                    'email' => $email,
                    'photo' => $photo,
                    'password' => $password
                ]);

                return response()->json([
                        'state' => true,
                        'message' => 'succes post data',
                        'data' => $user
                    ], 200);
            } catch (\Exception $e) {
                 return response()->json([
                        'state' => false,
                        'message' => 'failed post data',
                        'data' => 'mau nge hack ya ? ga bisa nerima script terlarang'
                    ], 400);
            }
            
    }
    
    public function editprofile(Request $request)
    {
        $ids = auth()->user()->id;
        
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'nullable|email|max:100',
            'password' => 'nullable|min:6',
            'status'=> 'required'
        ]);
        $photo = null;
                if ($request->hasFile('photo')) {
                    $photo = $this->saveFile($ids, $request->file('photo'));
                }
                
        $user = User::findOrFail($ids);
        $password = !empty($request->password) ? bcrypt($request->password):$user->password;
        $email = !empty($request->email)?($request->email):$user->email;
        $user->update([
            'name' => $request->name,
            'status' => 1,
            'email' => $email,
            'photo' => $photo,
            'password' => $password
        ]);
        if ($user) {
                return response()->json([
                    'state' => true,
                    'message' => 'succes edit data',
                ], 200);
            }
            return response()->json([
                'message' => 'failed edit data',
            ]);
        
    }
    
    private function saveFile($name, $photo)
    {
        $images = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension(). '.jpg';
        $path = public_path('uploads/identitas');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        } 
        Image::make($photo)->save($path . '/' . $images);
        return $images;
    }
    
    public function lempar(Request $request){
           
        $lempar = [
            'userid' => $request->userid,
            'hp' => $request->hp,
        ];    
        
        $user = user::where('userid' , $request->userid)->where('hp', $request->hp)->first();
        if ($user != null){
            $token = JWTAuth::fromUser($user);
                
            $data_body['user'] = $user;
            $data_body['token'] = $token;
                
            $response_client['state'] = true;
            $response_client['data'] = $data_body;
            $response_client['message'] = 'Data valid';
                
            return $response_client;
        }
        
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'http://ipehapp.intek.id/histore/user.php?userid='.$request->userid);
        $data = $response->getBody();
        
        
        $json = json_decode($data, true);
        
        if($json['success'] == '1'){
            $message = $json['message'];
            
            $hp = $message[0]['hp'];
            
            if($hp == $request->hp){
                
                $name = $message[0]['nama'];
                $karir = $message[0]['karir'];
                $hp = $message[0]['hp'];
                $provinsi = $message[0]['provinsi'];
                $email = $message[0]['email'];
                $ktp = $message[0]['ktp'];
                $alamat = $message[0]['alamat'];
                
                if($karir == 'Bintang 0'){
                    $role = "user";
                }else if($karir == 'Bintang 1'){
                    $role = "level1";
                }else if($karir == 'Bintang 2'){
                    $role = "level2";
                }else if($karir == 'Bintang 3'){
                    $role = "level3";
                }else if($karir == 'Bintang 4'){
                    $role = "level4";
                }
                
                $user = user::where('userid' , $request->userid)->first();
                
                if($user == null) {
                    $user = User::create([
                        'name' => $name,
                        'email' => $email,
                        'karir' => $karir,
                        'userid' => $request->userid,
                        'hp' => $hp,
                        'provinsi' => $provinsi,
                        'ktp' => $ktp,
                        'alamat' => $alamat,
                    ]);
                    $user->assignRole($role);
                    
                    
                    $token = JWTAuth::fromUser($user);
            
                    // return response()->json(compact('user','token'),201);
                    
                    $data_body['user'] = $user;
                    $data_body['token'] = $token;
                    
                    $response_client['state'] = true;
                    $response_client['data'] = $data_body;
                    $response_client['message'] = 'Data valid';
                    
                    return $response_client;
                }
                
                
                
                $token = JWTAuth::fromUser($user);
                
                $data_body['user'] = $user;
                $data_body['token'] = $token;
                
                $response_client['state'] = true;
                $response_client['data'] = $data_body;
                $response_client['message'] = 'Data valid';
                
                return $response_client;
                
            }else{
                $response_client['state'] = false;
                $response_client['data'] = null;
                $response_client['message'] = 'Data not found';
            }
        }else{
            $response_client['state'] = false;
            $response_client['data'] = null;
            $response_client['message'] = 'Data not found';
        }
        
        
        return $response_client;
        
       
    }
    
    
    public function index()
    {
        $users = User::orderBy('created_at', 'DESC')->paginate(10);
      $roles = Role::all();
        return view('users.index', compact('users','roles'));
    }

    public function create()
    {
        $role = Role::orderBy('name', 'ASC')->get();
        return view('users.create', compact('role'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|string|exists:roles,name',
          

        ]);

        $user = User::firstOrCreate([
            'email' => $request->email,
        ], [
            'name' => $request->name,
            'password' => Hash::make($request['password']),
            'status' => true
        ]);

        $user->assignRole($request->role);
        return redirect(route('users.index'))->with(['success' => 'User: <strong>' . $user->name . '</strong> Ditambahkan']);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
        ]);

        $user = User::findOrFail($id);
        $password = !empty($request->password) ? bcrypt($request->password):$user->password;
        $user->update([
            'name' => $request->name,
            'password' => $password
        ]);
        return redirect(route('users.index'))->with(['success' => 'User: <strong>' . $user->name . '</strong> Diperbaharui']);
    }
    
    
    
    public function editu(Request $request)
    {
        $ids = auth()->user()->id;
         try {
                $photo = null;
                if ($request->hasFile('photo')) {
                    $photo = $this->saveFile($ids, $request->file('photo'));
                }

                $user = User::findOrFail($ids);
                
                if($user->password == null){
                    
                $name = !empty($request->name)?($request->name):$user->name;
                $password = !empty($request->password) ? bcrypt($request->password):$user->password;
                $status = !empty($request->status)?($request->status):$user->status;
                $photo = !empty($request->photo)?($photo):$user->photo;
                $user->update([
                    'name' => $name,
                    'status' => $status,
                    'photo' => $photo,
                    'password' => $password
                ]);
            

                return response()->json([
                        'state' => true,
                        'message' => 'succes post data',
                        'data' => $user,
                    ], 200);
                    
                }else if (Hash::check($request->old_password, $user->password)) { 
                       $user->fill([
                        'old_password' => Hash::make($request->password)
                        ])->save();
                        
                $name = !empty($request->name)?($request->name):$user->name;
                $password = !empty($request->password) ? bcrypt($request->password):$user->password;
                $status = !empty($request->status)?($request->status):$user->status;
                $photo = !empty($request->photo)?($photo):$user->photo;
                $user->update([
                    'name' => $name,
                    'status' => $status,
                    'photo' => $photo,
                    'password' => $password
                ]);
            

                return response()->json([
                        'state' => true,
                        'message' => 'succes post data',
                        'data' => $user,
                    ], 200);
                        
                        
                }else{
                    return response()->json([
                        'state' => false,
                        'message' => 'password anda beda',
                    ], 401);
                }
                
                
            } catch (\Exception $e) {
                 return response()->json([
                        'state' => false,
                        'message' => 'failed post data',
                        'data' => 'mau nge hack ya ? ga bisa nerima script terlarang'
                    ], 400);
            }
        
        
    }
    

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with(['success' => 'User: <strong>' . $user->name . '</strong> Dihapus']);
    }

    public function roles(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all()->pluck('name');
        return view('users.roles', compact('user', 'roles'));
    }

    public function setRole(Request $request, $id)
    {
        $this->validate($request, [
            'role' => 'required'
        ]);

        $user = User::findOrFail($id);
        $user->syncRoles($request->role);
        return redirect()->back()->with(['success' => 'Role Sudah Di Set']);
    }

    public function rolePermission(Request $request)
    {
        $role = $request->get('role');
        $permissions = null;
        $hasPermission = null;

        $roles = Role::all()->pluck('name');

        if (!empty($role)) {
            $getRole = Role::findByName($role);
            $hasPermission = DB::table('role_has_permissions')
                ->select('permissions.name')
                ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                ->where('role_id', $getRole->id)->get()->pluck('name')->all();
            $permissions = Permission::all()->pluck('name');
        }
        return view('users.role_permission', compact('roles', 'permissions', 'hasPermission'));
    }

    public function addPermission(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:permissions'
        ]);

        $permission = Permission::firstOrCreate([
            'name' => $request->name,
            'guard_name' => $request->guard_name
            ]);
        return redirect()->back();
    }

    public function setRolePermission(Request $request, $role)
    {
        $role = Role::findByName($role);
        $role->syncPermissions($request->permission);
        return redirect()->back()->with(['success' => 'Permission to Role Saved!']);
    }
    
     public function daftar()
    {
        $role = Role::orderBy('name', 'ASC')->get();
        return view('users.daftar', compact('role'));
    }

    public function daftarmasuk(Request $request)
    {
        $token = Str::random(100);
        
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|string|exists:roles,name',
          

        ]);

        $user = User::firstOrCreate([
            'email' => $request->email,
        ], [
            'name' => $request->name,
            'password' => Hash::make($request['password']),
            'status' => true
            
        ]);
   

        $user->assignRole($request->role);
        return redirect(route('login'))->with(['success' => 'User: <strong>' . $user->name . '</strong> telah dibuat']);
    }
    


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    public function register(Request $request)
    {
        $role = "user";
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
         
        $check= email::where('email',$request->email)->first();
            
            if($validator->fails()){
            return response()->json([
                        'state' => false,
                        'message' => "The email has already been taken"
                    ], 401);
        }
           if($check){ 
               
               $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
                'status' => true
           ]);
            }
            else if(!$check){
                return response()->json([
                    'state' => false,
                    'message' => 'anda bukan anggota Hipo harap menghubungi CS'
                    ], 401);
            }

        $user->assignRole($role);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        if ($user) {
            // $data = DB::table('users')->select('id', 'name','karir', 'email', 'status','userid','hp','kota','provinsi','ktp','karir')->where('email',$user->email)->first();
            $data = User::where('email', $user->email)->first();
            return response()->json([
                    'state' => true,
                    'message' => 'succes get data',
                    'data' => $data
                ], 200);
            }
            return response()->json([
                'message' => 'failed get data',
                'data' => []
            ]);
    }

    public function logout(Request $request) 
    {
        config([
            'jwt.blacklist_enabled' => true
        ]);
        \Cookie::forget('token');
        auth()->logout();
        JWTAuth::invalidate(JWTAuth::parseToken());
        return response()->json(['message' => 'Successfully logged out']);
    }
    
    
    public function cari_user_status(Request $request)
    {
       
     $users = User::orderBy('created_at', 'DESC')->paginate(10);
         if (!empty($request->nama)) {
            $users =  User::orderBy('created_at', 'DESC')
            ->where('name', $request->nama)
            ->paginate(1000)
            ->setpath('');
 return view('users.index',  compact('users'),);
        }
      if (!empty($request->email)) {
            $users =  User::orderBy('created_at', 'DESC')
            ->where('email', $request->email)
            ->paginate(1000)
            ->setpath('');
 return view('users.index',  compact('users'),);
        }
         if (!empty($request->status)) {

            if ($request->status == "2"){
$status="0";


            }else if($request->status == "1"){
$status="1";

            }

            $users =  User::orderBy('created_at', 'DESC')
            ->where('status_mitra', $status)
            ->paginate(1000)
            ->setpath('');
 return view('users.index',  compact('users'),);
         }
           
        
       
        
    
     
    
}


    public function editadmin($id){
        
        $user=User::where('id',$id)->first();
        
        
        
        return view('users.adminedit',compact('user'));
        
        
        
        
    }
    
     public function updateadmin(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|email|',
            'password' => 'nullable|min:6',
        ]);

        $user = User::findOrFail($id);
        $password = !empty($request->password) ? bcrypt($request->password):$user->password;
        $user->update([
            'name' => $request->name,
            'email'=>$request->email,
            'password' => $password
        ]);
        return redirect(route('logout'));

    }

    public function otphistore(Request $request)
    {
       $userid = auth()->user()->id;
        
        
        $otp = Otp::where('otp',$request->otp)->where('user_id', $userid)->first();
        $user = User::where('id', $userid)->first();

            
        
     
      
        if($otp != null && $otp->status == 0 && $request->otp == $otp->otp ){

            $otp->update([
                'status' => 1
                ]);
            $user->update([
                'status' => 1
            ]);

            return response()->json([
                 'state' =>true,
                'message' => 'mantap otp kamu berhasil',
            ],200);
     
            
        }
        
        else{
            
             return response()->json([
                 'state' =>false,
                'message' => 'salah otp kamu',
            ],401);
            
            
        }
    }

    public function mailhistore(Request $request){
        
        $userid = auth()->user()->id;
        $email = $request->email;
        $name = auth()->user()->name;
        $stat = 0 ;
        $to_name = $name;
        $to_email = $email;
        $rand = rand(100000,999999);
        
        $user = User::where('id', $userid)->first();
        
        $user->update([
                'email' => $email
                ]);
                
        Otp::create([
                'otp' => $rand,
                'status' => $stat,
                'user_id' => $userid
            ]);
            
        $data = array('nama'=> $name,
                       'otp'=> $rand 
        );
        
        Mail::send('mailhistore', $data, function($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)
        ->subject('Kode OTP');
        $message->from('noreply@histore.id','Histore');
            $header=$message->getSwiftMessage();
            $kepala=$header->getHeaders();
            $kepala->addTextHeader('x-mailgun-native-send', 'true');
        
        
        
        });
        
        return response()->json([
                        'state' => true,
                        'message' => 'Email Was Sent to '.$to_email. ' Bila tidak ada di inbox bisa check folder spam',
                    ], 200);

    
    }
    
    
    
    
}
