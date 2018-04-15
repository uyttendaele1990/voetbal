<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\admin\admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Mail\UpdateEmail;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = admin::all();
        return view('admin.admin.show', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin.admin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        //eerst valideren zodat de verplichte velden zeker ingevuld zijn voordt ze worden opgeslaan
        //foto validatie zorgt er voor dat je enkel een jpeg, bmp, png bestand kunt uploaden
         $this->validate($request, [
            'name'       => 'required | unique:admins',
            'email'      => 'required | email | unique:admins',
            'password'   => 'required | confirmed | min:6',
            'avatar'     => 'mimes:jpeg,bmp,png'
            ]);
         //indien er een avatar is geüpload
         if($request->hasFile('avatar')){
            // originele naam van de file behouden
            // $request->avatar->getClientOriginalName();
            //de avatar opslaan onder storage/app/public/avatar
            $request->avatar->store('public/avatar');
            //de route/bestandsnaam opslaan zodat je nog met de avatar kunt werken
            //de public wegdoen want onze root (voatbal.app staat al ingesteld op voetbal/public)
            $avatar = $request->avatar->store('avatar');
         } else {
            //indien er geen avatar word geüpload krijgt de user het default avatar'tje
            $avatar = "avatar/default.png";
         }
        
        $request->password = bcrypt($request->password);

        //niewe array maken die we in de db kunnen steken onder de tbl spelers
        $admin = new admin;
        //variabelen opslaan
        $admin->remember_token   = $request->_token;
        $admin->password         = $request->password;
        $admin->name             = $request->name;
        $admin->email            = $request->email;
        $admin->avatar           = $avatar;
        //de data in de db opslaan
        $admin->save();
        return redirect(route('admin.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = admin::where('id', $id)->first();
        return view('admin.admin.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->name == 'admin' || Auth::user()->id == $id){
         $this->validate($request, [
            'name' => 'required | string ',
            'email' => 'required | email ',
            'avatar' => 'mimes:jpeg,bmp,png'
           ]); 
            $user = admin::find($id);
            if($request->check){
              $this->validate($request, [
                'password'   => 'required | confirmed | min:6'
                ]);
                $pass= $request->password;
                $request->password = bcrypt($request->password);
                $user->password   = $request->password;
            }
            if(($request->name !== $user->name) && ($user->name)){
                $this->validate($request, [
                    'name'       => 'required | unique:admins'
                ]);
                $user->name       = $request->name;
              }

            if($request->hasFile('avatar')){
                $request->avatar->store('public/avatar');
                if($user->avatar !== null ){
                    //de oude foto deleten
                   Storage::delete($user->avatar);
               }
            $avatar = $request->avatar->store('avatar');
            $user->avatar               = $avatar;
            } 

            if($request->seizoen){
                $user->seizoen = 1;
            } else {
                $user->seizoen = 0;
            }

            if(($request->check) || ($request->email !== $user->email)){
             if(isset($pass)){
              $user->password = $pass;
             }else{
                $pas =$user->password;
                $user->password = '';
             }
             if($request->email !== $user->email){
                $this->validate($request, [
                    'email'       => 'required | email | unique:admins'
                ]);
                $user->email       = $request->email;
              }
            Mail::to($user['email'])->send(new UpdateEmail($user));
            if(isset($pass)){
              $user->password = bcrypt($pass);
             } else {
                $user->password = $pas;
             }
            }
           $user->save();
           if(Auth::user()->name == 'admin'){
           return redirect(route('admin.index'));
            }else {
                return redirect(route('admin.home'));
            }
        } else {
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        admin::where('id', $id)->delete();
        return redirect()->back();
    }
}
