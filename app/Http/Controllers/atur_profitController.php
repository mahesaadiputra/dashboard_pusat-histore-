<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\atur_profit;

class atur_profitController extends Controller
{
     public function index()
     {
        $atur_profit=atur_profit::orderBy('nama_karir','ASC')->paginate(10);
        
        return view('atur_profit.index',compact('atur_profit'));
     }
     
      public function store(Request $request)
    {
        
       atur_profit::create($request->all());
       
       return back();
        
    }
     
     public function edit($id)
     {
        $atur_profit = atur_profit::find($id);
        return view('atur_profit.edit', ['atur_profit' => $atur_profit]);
     }
     
       public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_karir'   => 'required',
            'profit'   => 'required'
            
        ]);

            // Validate the request...

        try {
            $atur_profit = atur_profit::findOrFail($id);
            
            $atur_profit->update([
                'nama_karir' => $request->nama_karir,
                'profit' => $request->profit
                
            ]);
            return redirect(route('atur_profit.index'))->with(['success' => 'atur_profit: ' . $atur_profit->nama_karir . ' di update']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
