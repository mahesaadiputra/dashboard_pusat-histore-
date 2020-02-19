<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topup extends Model
{
    protected $guarded = [];
    protected $fillable = ['user_id','bank_id','jumlah','status','created_at','updated_at','invoice','photo'];

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
       public function anggota()
    {
        return $this->belongsTo('App\anggota','user_id');
    }

}
