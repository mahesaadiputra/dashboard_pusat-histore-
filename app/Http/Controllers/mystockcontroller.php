<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\stocktable;
Use Auth;

class mystockcontroller extends Controller
{
    public function index(Request $req){
$id=Auth::user()->id;
$stock=stocktable::select(
['st.id',
'nama',
'product',
'categories.name',
'status',
'st.photo'
]
)->join('categories','categories.id','=','st.kategori')
->where('userid',$id)
->get();

return $stock;

return view('my_stock.index',compact('stock'));


    }
}
