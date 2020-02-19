<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class komisi extends Model
{
    protected $table='komisi';
    protected $fillable=['id_akun','id_nama','jumlah','jumlah_sebelumnya','status','no_inv'];
}
