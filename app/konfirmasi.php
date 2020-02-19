<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class konfirmasi extends Model
{
    protected $table="approval";


    protected $fillable=['user_id','status','nama_product','product_id','nama_cabang','jumlah_request','photo','kategori','barcode','role','waktu_kirim'];

    public $timestamps=false;
}
