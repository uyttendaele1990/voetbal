<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
	public function user()
	{
		return $this->belongsTo('App\Model\user\User');
	}
	public function team()
	{
		return $this->belongsTo('App\Model\admin\teams');
	}
	
}
