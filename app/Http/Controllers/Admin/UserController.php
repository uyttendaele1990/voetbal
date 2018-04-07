<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('admin.user.show', compact('users'));
    }

    public function edit($id)
    {
         $user = User::where('id', $id)->first();
        return view('admin.user.user', compact('user'));
    }

    public function update(Request $request, $id)
    { 
        $this->validate($request, [
        'name' => 'required | string',
        'email' => 'required | email',
        'avatar' => 'mimes:jpeg,bmp,png'
       ]); 
        $user = User::where('id', $id)->first();
        if($request->hasFile('avatar')){
            $request->avatar->store('public/avatar');
            if($user->avatar !== null ){
                //de oude foto deleten
               Storage::delete($user->avatar);
           }
        $avatar = $request->avatar->store('avatar');
        $user->avatar               = $avatar;
        }      
       $user->name = $request->name;
       $user->email = $request->email;
       $user->save();

       return redirect(route('user.index'));
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back();
    }
}
