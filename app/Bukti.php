<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bukti extends Model
{
    protected $guarded = [];
    protected $fillable = ['invoice','user_id','jumlah','status','jenis_bank','no_va'];

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
    
    public function anggota()
    {
        return $this->belongsTo('App\anggota','user_id');
    }

   
}
