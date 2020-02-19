<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cair_komisi extends Model
{
    protected $table="cair_komisi";
    protected $fillable=['id_akun','id_nama','jumlah_pencairan','tanggal_masuk'];
    
 public $timestamps=false;
}
