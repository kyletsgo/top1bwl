<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function functions()
    {
        return $this->hasMany('App\Functions');
    }
}
