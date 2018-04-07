<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;

class teams extends Model
{
    protected $fillable = [
    	'naam',
    	'logo',
    	'goalen_voor',
    	'slug',
    	'goalen_tegen',
    	'punten',
    	'aantal_wedstrijden'

    ];
    public function wedstrijden()
    {
    	return $this->hasMany('App\Model\admin\wedstrijden\team1_id');
    }
    public function spelers()
    {
    	return $this->hasMany('App\Model\admin\spelers');
    }
}
