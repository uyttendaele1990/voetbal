<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;

class spelers extends Model
{
    protected $fillable = [
    	'naam',
    	'foto',
    	'doelpunten_saldo',
    	'teams_id'

    ];
    public function teams()
    {
    	return $this->belongsTo('App\Model\admin\teams');
    }
}
