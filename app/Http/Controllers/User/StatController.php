<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\admin\spelers;


class StatController extends Controller
{
    public function index()
    {
       	$teams = DB::select('select * from teams ORDER BY punten DESC, aantal_wedstrijden DESC,wedstrijden_gewonnen DESC, doelsaldo DESC');
       	$spelers = spelers::where('id', '>', '-1')->OrderBy('doelpunten_saldo', 'desc')->take(5)->get();
        return view('user/stats/stats', compact('teams', 'spelers'));
    }
}
