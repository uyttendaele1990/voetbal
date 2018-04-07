<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;

class opmerkingen extends Model
{
  	public function wedstrijden()
	{
		return $this->BelongsTo('App\Model\admin\wedstrijden');
	}
}