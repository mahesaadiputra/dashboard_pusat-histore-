<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bagi_profit extends Model
{
    protected $table='bagi_profit';
    protected $fillable = ['jenis_bintang','profit'];
    
    public $timestamps = false;
}
