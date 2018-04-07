<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\admin\teams;

class StatController extends Controller
{
    public function index()
    {
       	$teams = DB::select('select * from teams ORDER BY punten DESC, aantal_wedstrijden DESC, wedstrijden_gewonnen DESC, doelsaldo DESC');   
        return view('admin/stats/show' , compact('teams'));
    }
}
