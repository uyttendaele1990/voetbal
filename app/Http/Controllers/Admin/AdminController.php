<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\admin\admin;
use Illuminate\Support\Facades\Storage;
use App\Model\admin\wedstrijden;

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
            'naam'       => 'required | unique:admins',
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
        $admin->naam             = $request->naam;
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

         $this->validate($request, [
            'naam' => 'required | string',
            'email' => 'required | email',
            'avatar' => 'mimes:jpeg,bmp,png'
           ]); 
           $admin = admin::where('id', $id)->first();
            if($request->hasFile('avatar')){
                $request->avatar->store('public/avatar');
                if($admin->avatar !== null ){
                    //de oude foto deleten
                   Storage::delete($admin->avatar);
               }
            $avatar = $request->avatar->store('avatar');
            $admin->avatar               = $avatar;
            }      
           $admin->naam = $request->naam;
           $admin->email = $request->email;
           $admin->save();

           return redirect(route('admin.index'));
    }

    public function destroy($id)
    {
        admin::where('id', $id)->delete();
        return redirect()->back();
    }
}
