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
use App\anggota;
use App\Exports\anggotaexport;
use Maatwebsite\Excel\Facades\Excel;


class anggotaController extends Controller
{
    
  public function export_excel()
    {
        return Excel::download(new anggotaexport, 'anggota.xlsx');
    }
    
    
    public function index()
    {
        $users = anggota::orderBy('created_at', 'DESC')->paginate(10);

        $hitung=anggota::count();
     
        return view('anggota.index', compact('users','hitung'));
    }

    public function create()
    {
     
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:anggota',
            'password' => 'required|min:6',
           
          

        ]);

        $user = anggota::create([
            'email' => $request->email,
        ], [
            'name' => $request->name,
            'password' => Hash::make($request['password']),
            'status' => true
        ]);

      
        return redirect(route('anggota'))->with(['success' => 'User: <strong>' . $user->name . '</strong> Ditambahkan']);
    }

    public function edit($id)
    {
        $user = anggota::findOrFail($id);
        return view('anggota.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|email|exists:users,email',
            'password' => 'nullable|min:6',
        ]);

        $user = anggota::findOrFail($id);
        $password = !empty($request->password) ? bcrypt($request->password):$user->password;
        $user->update([
            'email'=>$request->email,
            'name' => $request->name,
            'password' => $password
        ]);
        return redirect(route('anggota'))->with(['success' => 'User: <strong>' . $user->name . '</strong> Diperbaharui']);
    }
    
    
 
    

    public function destroy($id)
    {
        $user = anggota::findOrFail($id);
        $user->delete();
        return redirect()->back()->with(['success' => 'User: <strong>' . $user->name . '</strong> Dihapus']);
    }

    public function roles(Request $request, $id)
    {
        $user = anggota::findOrFail($id);
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

  


    


    
   public function cari_user_status(Request $request)
    {

        $jumlah=anggota::count();

       
     $users = anggota::orderBy('created_at', 'DESC')->paginate(10);
         if (!empty($request->nama)) {
            $users =  anggota::orderBy('created_at', 'DESC')
            ->where('name','LIKE', "%$request->nama%")
            ->paginate($jumlah)
            ->setpath('');
            $hitung =  anggota::
            where('name','LIKE',"%$request->nama%")->count();


 return view('anggota.index',  compact('users','hitung'),);
        }
      if (!empty($request->email)) {
            $users =  anggota::orderBy('created_at', 'DESC')
            ->where('email','LIKE', "%$request->email%")
            ->paginate($jumlah)
            ->setpath('');
             $hitung =  anggota::
            where('email','LIKE', "%$request->email%")
            ->count();
 return view('anggota.index',  compact('users','hitung'),);
        }
         if (!empty($request->status)) {

            if ($request->status == "2"){
$status="0";


            }else if($request->status == "1"){
$status="1";

            }

            $users =  anggota::orderBy('created_at', 'DESC')
            ->where('status_mitra', $status)
            ->paginate($jumlah)
            ->setpath('');
            $hitung =  anggota::where('status_mitra', $status)
            ->count();



 return view('anggota.index',  compact('users','hitung'),);
         }
           
        
       
        
    
     
    
}
        
       
        
    
     
    
}


 
    
    
    
    
    
    

