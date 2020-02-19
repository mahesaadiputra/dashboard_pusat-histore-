<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subsidi extends Model
{
    protected $table='subsidi';
    
    public $timestamps=false;
    
    protected $fillable=['level_bintang','potongan'];
}
