<?php
 
namespace App\Exports;
 
use App\anggota;
use Maatwebsite\Excel\Concerns\FromCollection;
 
class anggotaexport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
         return anggota::all();


         
    }
}