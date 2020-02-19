<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\retur_data;
use File;
use Image;

class ReturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $retur = retur_data::orderBy('created_at','DSC')->paginate(10);
        return view('retur.index', ['retur' => $retur]);
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
            'photo' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        try {
            $photo = null;
            if ($request->hasFile('bukti')) {
                $photo = $this->saveFile($request->title, $request->file('bukti'));
            }
            
        
            $retur_data = retur_data::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'nama_mitra' => $request->nama_mitra,
                'kode_invoice' => $request->kode_invoice,
                'tanggal_order' => $request->tanggal_order,
                'alasan_retur' => $request->alasan_retur,
                'alamat_retur' => $request->alamat_retur,
                // 'buk' => $request->email,
                'bukti' => $photo
            ]);
            // return redirect(route('retur.success'));

            // return $retur_data;

            return view('retur.success');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    private function saveFile($name, $photo)
    {
        $images = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension();
        $path = public_path('uploads/retur');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true, true);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $retur = retur_data::find($id);

        if(!$retur){
            abort(404);
        }

        return view('retur.edit')->with('retur', $retur);
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
            'status' => 'required|string',
            'kode_invoice' => 'nullable|string',
        ]);

        try {
            $retur = retur_data::findOrFail($id);
            $photo = $retur->bukti;

            if ($request->hasFile('bukti')) {
                !empty($photo) ? File::delete(public_path('uploads/retur' . $photo)):null;
                $photo = $this->saveFile($request->name, $request->file('bukti'));
            }
            

            $retur->update([
                'kode_invoice' => $request->kode_invoice,
                'status' => $request->status,
                'bukti' => $photo,
            ]);

            return redirect(route('retur.index'))
                ->with(['success' => '<strong>' . $retur->kode_invoice . '</strong> Diperbaharui']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
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
        $retur = retur_data::findOrFail($id);
        if (!empty($retur->bukti)) {
            File::delete(public_path('uploads/retur/' . $retur->bukti));
        }
        $retur->delete();
        return redirect()->back()->with(['success' => '<strong>' . $retur->nama . '</strong> Telah Dihapus!']);
    }
}
