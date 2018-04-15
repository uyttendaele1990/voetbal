<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;

class opmerkingen extends Model
{
	 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gele_kaarten',
        'aantal_geel',
        'gescoord_door',
        'aantal_gescoord',
        'rode_kaarten',
        'wissel',
        'wissel_speler'
    ];

  	public function wedstrijden()
	{
		return $this->BelongsTo('App\Model\admin\wedstrijden');
	}
}