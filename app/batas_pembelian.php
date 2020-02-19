<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class batas_pembelian extends Model
{
    protected $table = 'batas_pembelian';
     protected $fillable=['karir','batas'];
     public $timestamps= false;
}
