<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    public function teams()
    {
    	return $this->belongsTo('App\Model\admin\teams');
    }
    public function users()
    {
    	return $this->belongsTo('App\Model\admin\users');
    }
}
