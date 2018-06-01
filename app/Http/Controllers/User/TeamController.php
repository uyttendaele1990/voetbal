<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\admin\teams;
use App\Model\user\Email;
use App\Model\user\like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{

    public function index()
    {
        $users = Email::where('user_id', Auth::user()->id)->get();
        $teams = teams::all();
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
        foreach($wedstrijden as $wedstrijd){
            if($wedstrijd->status == 0){
                $datum = date_parse($wedstrijd->gespeeld_op);
                 $wedstrijd->gespeeld_op = $datum['day'].'/'.$datum['month'];
            }
        }
        return view('user/teams/personal', compact('team', 'teams', 'wedstrijden'));
    }
    public function getAllTeams(){
        return $teams = teams::select('*')->with(['likes', 'email'])->orderBy('id','asc')->get();
                                                                // ->where('user_id', Auth::user()->id)
    }
    public function saveLike(request $request){
        $check = like::where(['user_id' => Auth::user()->id, 'team_id'=>$request->id])->first();
        if($check){
            like::where(['user_id' => Auth::user()->id, 'team_id'=>$request->id])->delete();
            return 'deleted';
        } else {
            $like= new like;
            $like->user_id = Auth::user()->id;
            $like->team_id= $request->id;
            $like->save();
        }
        
    }

}
