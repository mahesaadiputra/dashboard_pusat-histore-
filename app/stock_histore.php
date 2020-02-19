<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stock_histore extends Model
{
    protected $table="stock_histore";

    protected $fillable=['product_id','user_id','stock'];

    public $timestamps=false;
}
