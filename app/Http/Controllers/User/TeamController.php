<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\admin\teams;
use App\Model\admin\spelers;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{

    public function index()
    {
        $teams = DB::select('select * from teams ORDER BY punten DESC, aantal_wedstrijden DESC,wedstrijden_gewonnen DESC, doelsaldo DESC');
        return view('user/teams/teams', compact('teams'));
    }

    public function show($id)
    {   
        $teams = teams::where('id', $id)->first();
        $spelers = spelers::where('teams_id', $id)->get();
        return view('user/teams/show', compact('teams', 'spelers'));;
    }

}
