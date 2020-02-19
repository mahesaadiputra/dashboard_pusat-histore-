<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class voucher extends Model
{
    protected $table='voucher';
    protected $fillable=['nama','potongan','potongan_tampil','kode_voucher','status','pemakaian','maks'];
}
