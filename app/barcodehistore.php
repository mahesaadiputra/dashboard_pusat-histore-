<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class barcodehistore extends Model
{
    protected $table="barcode_histore";
    protected $fillable=['barcode','product_id'];
    public $timestamps=false;
}
