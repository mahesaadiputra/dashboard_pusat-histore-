<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bantuan extends Model
{
    protected $guarded = [];
    protected $fillable = ['whatapps', 'alamat','link'];

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

}
