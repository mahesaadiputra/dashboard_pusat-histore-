<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class anggota extends Model
{
    
    
    protected $table="users";
      protected $fillable = [
    'mitra_id','jenis_bank','photo_ktp','no_rek','kota_id', 'ing','lat',   'id', 'name', 'email', 'password', 'status','role','userid','hp','kota','provinsi','ktp','karir','photo','alamat','statusanggota','tglbergabung','tglaktifpaket','saldodeposit','saldopoin', 'status', 'status_mitra', 'parent','profit','saldo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_at' , 'updated_at'
    ];

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
    public function rating()
    {
        return $this->hasMany(Rating::class);
    }
    
    public function bukti()
    {
        return $this->hasMany(Bukti::class);
    }
    
    public function stock_level()
    {
        return $this->hasMany(stock_level::class);
    }
    
    public function customer()
    {
        return $this->hasMany(Customer::class);
    }
    
    public function favorit()
    {
        return $this->hasMany(Favorit::class);
    }
    public function topup()
    {
        return $this->hasMany(Topup::class);
    }
    


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
