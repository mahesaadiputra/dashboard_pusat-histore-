<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class penampunganmodel extends Model
{
    protected $table='penampungan';
    public $timestamps = false;
    protected $fillable=['nama_penampungan'];
}
