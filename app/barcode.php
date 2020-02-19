<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class barcode extends Model
{
    protected $table="barcode";
    protected $fillable=['barcode','nama','product_id'];
    public $timestamps=false;
}
