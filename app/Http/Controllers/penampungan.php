<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\penampunganmodel;
class penampungan extends Controller
{
    


    public function index(Request $req){

$penampungan=penampunganmodel::orderby('nama_penampungan','ASC')->paginate(10);

			if(!empty($req->nama)){
					$penampungan=penampunganmodel::orderby('nama_penampungan','ASC')
					->where('nama_penampungan','LIKE',"%$req->nama%")
					->paginate('10');
					$penampungan->appends(['nama'=>$req->nama]);
								}
							return view('penampungan.index',compact('penampungan'));
										}



	public function update(Request $req){
				$penampungan=penampunganmodel::where('id',$req->id)->first();
				$penampungan
				->update([
					'nama_penampungan'=>$req->nama
						]);
							if($penampungan){

								return redirect()->route('penampungan')->with(['success'=>"penampungan berhasil di update"]);
											}


										}
	public function store(Request $req){
			$penampungan=penampunganmodel::create([
					'nama_penampungan'=>$req->nama
													]
												);

										if($penampungan){
												return redirect()->route('penampungan')->with(['success'=>"penampungan berhasil di buat"]);
														}

										}


	public function delete(Request $req){
				$penampungan= penampunganmodel::where('id',$req->id)->first();
				$penampungan->delete();
							if($penampungan){
								return redirect()->route('penampungan')->with(['success'=>"penampungan berhasil di hapus"]);
											}

										}



	}
