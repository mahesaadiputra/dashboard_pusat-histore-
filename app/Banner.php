<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $guarded = [];
    protected $fillable = ['title', 'photo','content'];
    protected $table='banner';
}
