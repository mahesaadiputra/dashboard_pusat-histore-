<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class penampungan extends Model
{
    protected $table='penampungan';

    protected $fillable=['nama_penampungan'];
    public $timestamps = false;
