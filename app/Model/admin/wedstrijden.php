<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;

class wedstrijden extends Model
{
	protected $fillable = [
		'team1_id',
		'team1_score',
		'team2_id',
		'team2_score',
		'status',

	]; 
	public function team1()
	{
		return $this->BelongsTo('App\Model\admin\teams');
	}
	
	public function opmerkingen()
	{
		return $this->hasMany('App\Model\admin\opmerkingen');
	}
}
