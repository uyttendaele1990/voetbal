<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\admin\teams;
use Illuminate\Support\Facades\DB;

class StatController extends Controller
{
    public function index()
    {
       	$teams = DB::select('select * from teams ORDER BY punten DESC, aantal_wedstrijden DESC,wedstrijden_gewonnen DESC, doelsaldo DESC');
        return view('user/stats/stats', compact('teams'));
    }
}
