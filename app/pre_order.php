<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pre_order extends Model
{
    protected $table="pre_order";
    protected $fillable=['photo','nama_product','qty','harga','status','tgl_kirim','tgl_terima','resi','alamat_kirim','vendor'];
    public $timestamps=false;
}
