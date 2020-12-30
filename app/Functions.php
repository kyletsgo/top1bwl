<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Functions extends Model
{
    protected $table = 'functions';

    public function menu()
    {
        return $this->hasOne('App\Menu', 'id', 'menu_id');
    }
}
