<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kebijakan extends Model
{
    protected $guarded = [];
    protected $fillable = ['title', 'body'];

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

}
