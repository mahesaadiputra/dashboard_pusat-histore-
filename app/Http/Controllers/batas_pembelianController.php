<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\batas_pembelian;

class batas_pembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $batas_pembelian=batas_pembelian::orderBy('karir','ASC')->paginate(10);
        
        return view('batas_pembelian.index',compact('batas_pembelian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
          $batas_pembelian=batas_pembelian::where('id',$id)->first();
        
        
        return view('batas_pembelian.edit',compact('batas_pembelian'));
        
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
         $this->validate($request,[
           
           'batas'=> 'required',  
           'karir'=> 'required'
           
           
           
           ]);
           
           
           try{
           
             $batas_pembelian=batas_pembelian::Where('id',$id)->first();
           
           
        $batas_pembelian->update([
            'karir'=>$request-> karir,
            'batas'=>$request-> batas,
            
            
            
            ]);
            
            return redirect(route('batas_pembelian.index'))->with(['success' => 'subsidi: ' . $batas_pembelian->batas . ' di update']);
            
           }catch (\Exception $e) {
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
        //
    }
}
