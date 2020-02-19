<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = "notifikasi_log";
    protected $primaryKey = "id";
    public $timestamps = false;
}
