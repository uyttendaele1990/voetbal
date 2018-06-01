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
        'doelsaldo',
    	'goalen_tegen',
    	'punten',
    	'aantal_wedstrijden',
        'wedstrijden_gewonnen',
        'wedstrijden_gelijk',
        'wedstrijden_verloren',

    ];

    public function wedstrijden()
    {
    	return $this->belongsToMany('App\Model\admin\wedstrijden');
    }

    public function spelers()
    {
    	return $this->hasMany('App\Model\admin\spelers');
    }
    public function email()
    {
        return $this->hasMany('App\Model\user\Email', 'team_id');
    }
    public function likes(){
        return $this->hasMany('App\Model\user\like', 'team_id');
    }
}
