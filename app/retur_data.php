<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class retur_data extends Model
{
    protected $guarded = [];
    protected $fillable = ['nama','email','nama_mitra','kode_invoice','tanggal_order','alasan_retur','alamat_retur','bukti','created_at','updated_at','status'];
}
