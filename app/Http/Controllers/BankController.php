<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bank;
use Auth;
use File;
use Image;

class BankController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bank = Bank::paginate(10);
        return view('bank.index', ['bank' => $bank]);
    }
    
    public function getbank()
    {
        $bank = Bank::all();
            if ($bank) {
                return response()->json([
                    'state' => true,
                    'message' => 'succes get data',
                    'data' => $bank
                ], 200);
            }
            return response()->json([
                'message' => 'failed get data',
                'data' => []
            ]);
    }

  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

                return view('bank.create');
        
   
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
            'nama_bank'   => 'required',
            'nama_pemilik' => 'required',
            'no_rek' => 'required',
              'photo' => 'nullable|image|mimes:jpg,png,jpeg'
          
        ]);
        
          $photo = null;
            if ($request->hasFile('photo')) {
                $photo = $this->saveFile($request->name_bank, $request->file('photo'));
            }

      
            $bank = Bank::create([
                'nama_bank' => $request->nama_bank,
                'nama_pemilik' => $request->nama_pemilik,
                'no_rek' => $request->no_rek,
                'photo'=>$photo,
            ]);
            return redirect(route('bank.index'))
                ->with(['success' => '<strong>' . $bank->nama_bank . '</strong> Ditambahkan']);
    }
    
    
    
    private function saveFile($name, $photo)
    {
        $images = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension();
        $path = public_path('uploads/bank/');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        } 
        Image::make($photo)->save($path . '/' . $images);
        return $images;
    }
    
    
    
    
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bank = Bank::find($id);

        if(!$bank){
            abort(404);
        }

        return view('bank.single')->with('bank', $bank);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bank = Bank::find($id);

        if(!$bank){
            abort(404);
        }

        return view('bank.edit')->with('bank', $bank);
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
            'nama_bank'   => 'required',
            'nama_pemilik'   => 'required',
            'no_rek' => 'required',
             'photo' => 'nullable|image|mimes:jpg,png,jpeg'
            
        ]);

            // Validate the request...

        try {
            $bank = Bank::findOrFail($id);
              $photo = $bank->photo;
              
              if ($request->hasFile('photo')) {
                !empty($photo) ? File::delete(public_path('uploads/bank/' . $photo)):null;
                $photo = $this->saveFile($request->nama_bank, $request->file('photo'));
            }
            $bank->update([
                'nama_bank' => $request->nama_bank,
                'nama_pemilik' => $request->nama_pemilik,
                'no_rek' => $request->no_rek,
                'photo' => $photo
                
            ]);
            return redirect(route('bank.index'))->with(['success' => 'Bank: ' . $bank->nama_bank . ' Ditambahkan']);
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
        $bank = Bank::find($id);
        $bank->delete();
        return redirect('bank')->with('message', 'halaman sudah di hapus !');
    }


    
}
