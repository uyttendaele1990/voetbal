<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;

class wedstrijden extends Model
{
	protected $fillable = [
		'team1_score',
		'team2_score',
		'status',

	]; 
	
	public function opmerkingen()
	{
		return $this->hasMany('App\Model\admin\opmerkingen');
	}

	public function teams()
	{
		return $this->belongsToMany('App\Model\admin\teams');
	}
}
