<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class atur_profit extends Model
{
    protected $table="atur_profit";
    
    protected $fillable=['nama_karir','profit'];
    
    public $timestamps = false;
}
