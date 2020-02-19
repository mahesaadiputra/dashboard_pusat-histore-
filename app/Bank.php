<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $guarded = [];
    protected $fillable = ['nama_bank', 'no_rek','nama_pemilik','photo'];

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

   
}
