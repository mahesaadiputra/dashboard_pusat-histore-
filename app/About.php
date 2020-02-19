<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Bank;
use Auth;

class About extends Model
{
    protected $guarded = [];
    protected $fillable = ['title', 'body'];

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

   
}
