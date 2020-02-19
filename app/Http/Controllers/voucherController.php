<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\voucher;

class voucherController extends Controller
{
    public function index(){
        $voucher= voucher::orderBy('created_at','DSC')->paginate(10);
     return view('voucher.index',compact('voucher'));   
        
    }


 public function cari(Request $request){

    $count=voucher::count();
        $voucher= voucher::orderBy('created_at','DSC')->where('nama','LIKE',"%$request->nama%")->paginate($count);
     return view('voucher.index',compact('voucher'));   
        
    }



public function edit($id){
    
    $voucher=voucher::where('id',$id)->first();
    
    return view('voucher.edit',compact('voucher'));
    
    
    
    
}

public function update(Request $request,$id){
      $this->validate($request, [
            'kode' => 'required|string|max:100',
            'judul' => 'required|max:100',
            'potongan' => 'required|max:100',
            'potongan_tampil'=>'required',
            'pemakaian' => 'required',
             'status'=>'required',
             'maks' => 'required'
        ]);

        try {
            $voucher = voucher::where('id',$id)->first();
            $voucher->update([
                'kode_voucher' => $request->kode,
                'nama' => $request->judul,
                'potongan' =>  $request->potongan,
                'potongan_tampil'=> $request->potongan_tampil,
                'pemakaian'=> $request->pemakaian,
                'status'=> $request->status,
                'maks'=> $request->maks
            ]);

            return redirect(route('voucher.index'))
                ->with(['success' => '<strong>' . $voucher->nama . '</strong> Diperbaharui']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
        
        
        
    
    
    
    
}


 public function destroy($id)
    {
        $voucher = voucher::findOrFail($id);
        $voucher->delete();
        return redirect()->back()->with(['success' => 'Kategori: ' . $voucher->nama . ' Telah Dihapus']);
    }


public function tambah(){
    
    return view('voucher.create');
    
    
    
}


 public function store(Request $request){
        
    
  $this->validate($request, [
           
            'kode' => 'required|string|max:100',
            'nama' => 'required|string|max:100',
            'potongan' => 'required|string|max:100',
            'tampil' => 'required|string|max:100',
            'pemakaian' => 'required',
              'status' => 'required|string|max:100',
              'maks' => 'required',
        ]);

        try {
           
        
            $voucher = voucher::create([
                'kode_voucher' => $request->kode,
                'nama' => $request->nama,
                'potongan' => $request->potongan,
                'potongan_tampil'=>$request->tampil,
                'pemakaian'=>$request->pemakaian,
                'status'=> $request->status,
                'maks'=> $request->maks
            ]);
            return redirect(route('voucher.index'))
                ->with(['success' => '<strong>' . $voucher->nama . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
        
    
        
        
        
        
        
    }


        
}






