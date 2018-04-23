<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\admin\wedstrijden;

class WedstrijdController extends Controller
{
    public function index()
    {
    	$wedstrijden = wedstrijden::select('*')->with('teams')->orderBy('gespeeld_op', 'DESC')->get();
        foreach($wedstrijden as $wedstrijd){
            if($wedstrijd->status == 0){
                $datum = date_parse($wedstrijd->gespeeld_op);
                 $wedstrijd->gespeeld_op = $datum['day'].'/'.$datum['month'];
            }
        }
        return view('user/wedstrijden/wedstrijden', compact('wedstrijden'));
    }

    public function show($id)
    {
        $wedstrijden = wedstrijden::where('id', $id)->first();
        return view('user/wedstrijden/show', compact('wedstrijden'));
    }
}

