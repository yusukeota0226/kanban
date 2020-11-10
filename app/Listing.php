<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    //１つのリストに複数のカードを持てるようにする
    public function cards()
    {
        return $this->hasMany('App\Card');
    }
}
