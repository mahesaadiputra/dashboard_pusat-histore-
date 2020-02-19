<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stocktable extends Model
{
    protected $table="st";
    protected $fillable=['userid','product','product_id','kategori','stock','photo','role','nama','status'];

    public $timestamps=false;
}
