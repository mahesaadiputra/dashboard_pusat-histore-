<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class log extends Controller
{
    function checkJSON($chatID,$update){
        $date = Carbon::now('Asia/Jakarta')->format('dmY');
        $myFile = "/var/log/app/{$date}_all_hipay.log";
        $updateArray = print_r($update,TRUE);
        $fh = fopen($myFile, 'a+') or die("can't open file");
        fwrite($fh, $chatID ."\n");
        fwrite($fh, $updateArray."\n");
        fclose($fh);
    }
}
