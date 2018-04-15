<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\admin\wedstrijden;

class WedstrijdController extends Controller
{
    public function index()
    {
    	$wedstrijden = wedstrijden::select('*')->with('teams')->orderBy('gespeeld_op', 'DESC')->get();
        return view('user/wedstrijden/wedstrijden', compact('wedstrijden'));
    }

    public function show($id)
    {
        $wedstrijden = wedstrijden::where('id', $id)->first();
        return view('user/wedstrijden/show', compact('wedstrijden'));
    }
}

