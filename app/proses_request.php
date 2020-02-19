<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class proses_request extends Model
{
     
    protected $fillable=[
        'user_id','jumlah_request','product_id','nama_product','photo','status','sisa_stock','nama_cabang','kategori'
        
        ];
   
    protected $table='proses_requests';
    
    protected $primarykey ='id';
public $timestamps = false;
    
}
