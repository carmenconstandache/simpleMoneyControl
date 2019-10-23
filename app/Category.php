<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    public function cost()
    {
        return $this->hasMany('App\Cost');
    }
}
