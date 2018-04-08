<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\admin\teams;
use App\Model\user\Email;
use Illuminate\Support\Facades\Auth;

class MailController extends Controller
{
    public function show($id)
    {
        $team = teams::where('id', $id)->first();
        $user = Auth::user();

        $email = new Email;
        $email->teams_id = $team->id;
        $email->users_id = $user->id;
        $email->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        $team = teams::where('id', $id)->first();
        $user = Auth::user();
        $emails = Email::all();
        foreach($emails as $email){
            if(($email->teams_id == $team->id) && ($email->users_id == $user->id)){
                $email->delete();
            }
        }
        return redirect()->back();
    }
}