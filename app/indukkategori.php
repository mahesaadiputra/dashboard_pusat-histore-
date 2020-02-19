<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class indukkategori extends Model
{
    protected $table="induk_category";

    protected $fillable=['name','photo','tampil','unggulan','deskripsi','next'];

    public $timestamps=false;
    
    
    
}
