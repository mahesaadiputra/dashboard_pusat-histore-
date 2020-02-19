<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bagi_profit;

class bagi_profitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bagi_profit=bagi_profit::orderBy('jenis_bintang','ASC')->paginate(10);
        
        return view('bagi_profit.index',compact('bagi_profit'));
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
        
       bagi_profit::create($request->all());
       
       return back();
        
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
         $bagi_profit = bagi_profit::find($id);
        return view('bagi_profit.edit', ['bagi_profit' => $bagi_profit]);
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
            'jenis_bintang'   => 'required',
            'profit'   => 'required'
            
        ]);

            // Validate the request...

        try {
            $bagi_profit = bagi_profit::findOrFail($id);
            
            $bagi_profit->update([
                'jenis_bintang' => $request->jenis_bintang,
                'profit' => $request->profit
                
            ]);
            return redirect(route('atur_hargajual.index'))->with(['success' => 'bagi_profit: ' . $bagi_profit->jenis_bintang . ' di update']);
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
         $bagi_profit = bagi_profit::find($id);
         $bagi_profit->delete();
         return redirect('/bagi_profit');
    }
}
