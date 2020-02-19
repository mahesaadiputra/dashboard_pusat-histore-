<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class batas_cair extends Model
{
    protected $table='batas_cair';
    public $timestamps=false;
    protected $filable=['nama_batas','jumlah'];
}
