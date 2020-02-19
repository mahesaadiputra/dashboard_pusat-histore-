<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jurnal extends Model
{
    protected $table='jurnal';
    
    protected $fillable=['id_akun','created_at','keterangan','debet','kredit','ref_jurnal','id_nama','no_inv','ref_id'];
    
}
