<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\About;
use App\Kebijakan;
use App\Bantuan;
use Auth;

class AboutController extends Controller
{
    public function getAbout()
    {
        $about = About::first();
            if ($about) {
                return response()->json([
                    'state' => true,
                    'message' => 'succes get data',
                    'data' => $about
                ], 200);
            }
            return response()->json([
                'message' => 'failed get data',
                'data' => []
            ]);
    }
    
    public function getCA()
    {
        $kebijakan = Kebijakan::all();
            if ($kebijakan) {
                return response()->json([
                    'state' => true,
                    'message' => 'succes get data',
                    'data' => $kebijakan
                ], 200);
            }
            return response()->json([
                'message' => 'failed get data',
                'data' => []
            ]);
    }
    
    public function getBantuan()
    {
        $bantuan = Bantuan::first();
            if ($bantuan) {
                return response()->json([
                    'state' => true,
                    'message' => 'succes get data',
                    'data' => $bantuan
                ], 200);
            }
            return response()->json([
                'message' => 'failed get data',
                'data' => []
            ]);
    }
    
    public function getBantuanM()
    {
        
       $bantuan = Bantuan::select(
                  'id',
                  'whatapps',
                  'link')
                  ->first();
        
            if ($bantuan) {
                return response()->json([
                    'state' => true,
                    'message' => 'succes get data',
                    'data' => $bantuan
                ], 200);
            }
            return response()->json([
                'message' => 'failed get data',
                'data' => []
            ]);
    }
    
}
