<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Mail\UpdateEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Model\admin\spelers;

class HomeController extends Controller
{
    public function index()
    {
        // $topscorers= DB::table('spelers')
        //             ->select('naam', 'foto', 'doelpunten_saldo')
        //             ->orderBy('doelpunten_saldo', 'desc')
        //             ->leftJoin('teams', 'spelers.teams_id', '=', 'teams.id')
        //             ->select('spelers.*', 'teams.naam as team')
        //             ->limit(3)
        //             ->get();
        $topscorers = spelers::select(['naam','foto','doelpunten_saldo', 'teams_id'])->with('teams')->orderBy('doelpunten_saldo','desc')->take(3)->get();
        // foreach($spelers as $speler){
        //   return $speler->teams->wedstrijden;dd(); 
        // }
        $winnaar = DB::select('select * from teams ORDER BY punten DESC, aantal_wedstrijden DESC,wedstrijden_gewonnen DESC, doelsaldo DESC LIMIT 1');
        return view('user/home', compact('winnaar', 'topscorers'));
    }

    public function update(Request $request, $id)
    {
          //niewe array maken die we in de db kunnen steken onder de tbl spelers
          $user = User::where('id', $id)->first();
          $this->validate($request, [
                'avatar'   => 'mimes:jpeg,bmp,png'
            ]);
          
          if($request->check){
              $this->validate($request, [
                'password'   => 'required | confirmed | min:6'
            ]);
            $pass= $request->password;
            $request->password = bcrypt($request->password);
            $user->password   = $request->password;
            $user->google= null;
          }
          
          if($request->name !== $user->name){
            $this->validate($request, [
                'name'       => 'required | unique:users'
            ]);
            $user->name       = $request->name;
          }
          
          if(($request->check) or ($request->email !== $user->email)){
             if($pass){
              $user->password = $pass;
             }
             if($request->email !== $user->email){
                $this->validate($request, [
                    'email'       => 'required | email | unique:users'
                ]);
                $user->email       = $request->email;
              }
            Mail::to($user['email'])->send(new UpdateEmail($user));
            if($pass){
              $user->password = bcrypt($pass);
             }
          }

         //indien er een foto is geüpload
         if($request->hasFile('avatar')){
           // Het pad van de avatar die overschreven word opslaan in var
           // $avatar = 'voetbal/storage/app'.url($speler->avatar); 
           //de avatar die overschreven word unlinken
           // unlink($avatar);
           // originele naam van de file behouden
           // $request->avatar->getClientOriginalName();
           // niewe avatar opslaan in storage/app/public/avatar
           $request->avatar->store('public/avatar');
           // het pad opslaan in var
           $avatar = $request->avatar->store('avatar');
           //ff checken of de user wel een avatar heeft(indien een admin een aanstootgevende avatar verwijderd ofziets, want normaal gezien heeft iedereen een avatar aangezien dat de validation rule in de store functie op required staat)
           if($user->avatar === null){
            }   else  {
           //de oude avatar deleten
           Storage::delete($user->avatar);
           }
           // var in db var steken zodat je het pad later kunt oproepen
           $user->avatar = $avatar;
           // de if beïndigen
           }
           
        $user->save();
        
        return redirect(route('home'));
    }   

    public function edit($id)
    {
            $user = Auth::user();
        return view('user/edit', compact('user'));
    }

    public function terms(){
      return view('terms');
    }

}



    

