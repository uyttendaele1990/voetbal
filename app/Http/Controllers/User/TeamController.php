<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\admin\teams;
use App\Model\user\Email;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{

    public function index()
    {
        $users = Email::where('user_id', Auth::user()->id)->get();
        $teams = DB::select('select * from teams ORDER BY punten DESC, aantal_wedstrijden DESC,wedstrijden_gewonnen DESC, doelsaldo DESC');
        return view('user/teams/teams', compact('teams', 'users'));
    }

    public function show($id)
    {   
        $teams = teams::where('id', $id)->first();
        $spelers = $teams->spelers;
        return view('user/teams/show', compact('teams', 'spelers'));;
    }

    public function personal($id)
    {
        $team = teams::where('id', $id)->first();
        $teams = teams::all();
        $wedstrijden = $team->wedstrijden;
        return view('user/teams/personal', compact('team', 'teams', 'wedstrijden'));
    }

}
