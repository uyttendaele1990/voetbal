<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\admin\teams;


class StatController extends Controller
{
    public function index()
    {
       	$teams = DB::select('select * from teams ORDER BY punten DESC, aantal_wedstrijden DESC,wedstrijden_gewonnen DESC, doelsaldo DESC');
       	$spelers = DB::select('select * from spelers ORDER BY doelpunten_saldo DESC LIMIT 5');
       	// // $spelers = teams::with(['spelers' => function ($query) {
    				// // 					$query->select('*');
    				// // 					$query->orderBy('doelpunten_saldo', 'DESC');
    				// // 					$query->limit(5);
								// // }])->get();
       	// return $spelers[2]->spelers;
        return view('user/stats/stats', compact('teams', 'spelers'));
    }
}
