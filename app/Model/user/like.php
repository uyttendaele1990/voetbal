<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    public function teams(){
        return $this->belongsTo('App\Model\admin\teams');
    }
}
