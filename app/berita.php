<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class berita extends Model
{
    protected $guarded = [];
    protected $fillable = ['title', 'photo','content','posisi','is_link','tampil'];
    protected $table='berita';

 
   
   
}
