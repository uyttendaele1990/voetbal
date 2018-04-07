<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        return view('user/home');
    }
     public function profile()
    {
    	$user = Auth::user();
        return view('user/profile', compact('user'));
    }

    public function update(Request $request, $id)
    {
            $user = User::where('id', $id)->first();
            $this->validate($request, [
                  'avatar'   => 'mimes:jpeg,bmp,png'
              ]);
            
            if($request->check){
                $this->validate($request, [
                  'password'   => 'required | confirmed | min:6'
              ]);
              $request->password = bcrypt($request->password);
              $user->password   = $request->password;
            }
            
            if($request->name !== $user->name){
              $this->validate($request, [
                  'name'       => 'required | unique:users'
              ]);
              $user->name       = $request->name;
            }
            
            if($request->email !== $user->email){
              $this->validate($request, [
                  'email'       => 'required | email | unique:users'
              ]);
              $user->email       = $request->email;
            }
            //niewe array maken die we in de db kunnen steken onder de tbl spelers
        
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
        
        return redirect(route('profile'));
        
    }   
    public function edit($id)
    {
            $user = Auth::user();
        return view('user/edit', compact('user'));
    }

}



    

