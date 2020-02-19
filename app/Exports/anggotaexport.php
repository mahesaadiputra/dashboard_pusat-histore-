<?php
 
namespace App\Exports;
 
use App\anggota;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
 
class anggotaexport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return anggota::orderby('name','ASC')->select(
            'id',
        	'userid',
        	'name',
            'email',
            'hp',
            'hp_mitra',
                'karir',
            'status_mitra',



        )->get();
    }



public function headings(): array
    {
        return [
            'no',
            'userid',
            'name',
            'Email',
            'no hp 1',
            'no hp 2',
            'karir',
            'status'

        ];
    }

}



