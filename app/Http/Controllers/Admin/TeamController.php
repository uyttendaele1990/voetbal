<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\admin\teams;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{

    public function index()
    {
        $teams = Teams::all();
        return view('admin/teams/show', compact('teams'));
    }

    public function create()
    { 
        return view('admin/teams/teams');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'naam'  => 'required | unique:teams',
            'slug'  => 'required | unique:teams',
            'image' => 'required | mimes:jpeg,bmp,png'
            ]);
        // een slug maken van de afkorting
        // $slug = str_slug($request->slug);
        $request->image->store('public/logo');
        $logo = $request->image->store('logo');
        $team       = new teams;
        $team->naam = $request->naam;
        $team->slug = $request->slug;
        $team->logo = $logo;
        $team->save();
        return redirect(route('teams.index'));
    }

    public function edit($id)
    {
        $teams = teams::where('id', $id)->first();
        return view('admin/teams/edit', compact('teams'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'naam'=> 'required',
            'slug'=> 'required',
            'image' => 'mimes:jpeg,bmp,png'
            ]);
        $team                     = teams::find($id);
        
        if($request->hasFile('image')){
            $request->image->store('public/logo');
            if($team->logo !== null ){
                //de oude foto deleten
               Storage::delete($team->logo);
           }
        $logo = $request->image->store('logo');
        $team->logo               = $logo;
        }
        
        $team->naam               = $request->naam;
        $team->slug               = $request->slug;
        $team->goalen_voor        = 0;
        $team->goalen_tegen       = 0;
        $team->punten             = 0;
        $team->aantal_wedstrijden = 0;
        $team->save();
        return redirect(route('teams.index'));
    }

    public function destroy($id)
    {
        $team = teams::where('id', $id)->first();
        Storage::delete($team->logo);
        teams::where('id', $id)->delete();
        return redirect()->back();
    }
}
