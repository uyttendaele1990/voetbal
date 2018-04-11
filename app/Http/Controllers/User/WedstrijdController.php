<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\admin\wedstrijden;
use App\Model\admin\teams;
use Illuminate\Support\Facades\DB;
use App\Model\admin\opmerkingen;
use App\Model\admin\spelers;

class WedstrijdController extends Controller
{
    public function index()
    {
    	$wedstrijden = DB::table('wedstrijdens')
                ->orderBy('gespeeld_op', 'desc')
                ->get();
        $teams = teams::all();
          //   $wedstrijd= wedstrijden::find(51);
          // return $wedstrijd->teams[0]->naam;dd();
        return view('user/wedstrijden/wedstrijden', compact('wedstrijden', 'teams'));
    }

    public function show($id)
    {
        $geel = opmerkingen::where('wedstrijden_id', $id)->pluck('gele_kaarten');
        $g1 = opmerkingen::where('wedstrijden_id', $id)->pluck('aantal_geel');
        $rood = opmerkingen::where('wedstrijden_id', $id)->pluck('rode_kaarten');
        $goal = opmerkingen::where('wedstrijden_id', $id)->pluck('gescoord_door');
        $wedstrijden = wedstrijden::where('id', $id)->first();
        $spelers1 = spelers::where('teams_id', $wedstrijden->teams[0]->id)->get();
        $spelers2 = spelers::where('teams_id', $wedstrijden->teams[1]->id)->get();
        $goal = opmerkingen::where('wedstrijden_id', $id)->pluck('gescoord_door');
        $gnr = opmerkingen::where('wedstrijden_id', $id)->pluck('aantal_gescoord');
        $wissel = opmerkingen::where('wedstrijden_id', $id)->pluck('wissel');
        $wissel_speler = opmerkingen::where('wedstrijden_id', $id)->pluck('wissel_speler');
        $team1 = teams::where('id', $wedstrijden->teams[0]->id)->first();
        $team2 = teams::where('id', $wedstrijden->teams[1]->id)->first();

        return view('user/wedstrijden/show', compact('wedstrijden', 'geel', 'rood', 'goal', 'spelers1', 'spelers2', 'g1', 'goal', 'gnr', 'wissel', 'wissel_speler', 'team1', 'team2'));
    }
}

