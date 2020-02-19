<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vendormodel extends Model
{
    protected $table="vendor";
    protected $fillable=['nama','alamat'];

    public $timestamps=false;
}
