<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\admin\wedstrijden;
use App\Model\admin\spelers;
use App\Model\admin\teams;
use App\Model\admin\opmerkingen;



class WedstrijdController extends Controller
{
    
    public function index()
    {
        $opmerkingen = opmerkingen::all();
        $wedstrijden = wedstrijden::all();
        $teams = teams::all();
        return view('admin/wedstrijden/show', compact('wedstrijden', 'opmerkingen', 'teams'));
    }

    public function create()
    {
        $teams = teams::all();
        $date = Date('Y-m-d');
        return view('admin/wedstrijden/wedstrijden', compact('teams', 'date'));
    }

    public function store(Request $request)
    {
        //kijken ofdat de checkbox is aangevinkt en naargelang de validation rules aanpassen en de var stat een andere value geven de score required is eigenlijk een dubbel check aangezien als status aangevinkt staat kan je eignelijk geen null doorgeven
        if(isset($request->status)){
                $this->validate($request, [
                    'team1'=> 'required | integer | different:team2',
                    'team2'=> 'required | integer | different:team1',
                    'team1_score' => 'required | integer | min:0',
                    'team2_score' => 'required | integer | min:0',
                    'gespeeld_op' => 'required | date | before:tomorrow'
                    ]);
                $status = 1;

           $team1 = teams::where('id', $request->team1)->first();
           $team2 = teams::where('id', $request->team2)->first();

            $team1->goalen_voor = $team1->goalen_voor + $request->team1_score;
            $team1->goalen_tegen = $team1->goalen_tegen + $request->team2_score;
            if($request->team1_score > $request->team2_score){
                $team1->wedstrijden_gewonnen = $team1->wedstrijden_gewonnen + 1;
                $team1->punten = $team1->punten + 3;
            } elseif ($request->team1_score < $request->team2_score) {
                $team1->wedstrijden_verloren =  $team1->wedstrijden_verloren + 1;
            } else {
                $team1->wedstrijden_gelijk = $team1->wedstrijden_gelijk + 1;
                $team1->punten = $team1->punten + 1;
            }
            $team1->aantal_wedstrijden = $team1->aantal_wedstrijden + 1;
            $team1->doelsaldo = $team1->goalen_voor - $team1->goalen_tegen;
            $team1->save();
            
            $team2->goalen_voor = $team2->goalen_voor + $request->team2_score;
            $team2->goalen_tegen = $team2->goalen_tegen + $request->team1_score;
            if($request->team2_score > $request->team1_score){
                $team2->wedstrijden_gewonnen = $team2->wedstrijden_gewonnen + 1;
                $team2->punten = $team2->punten + 3;
            } elseif ($request->team2_score < $request->team1_score) {
                $team2->wedstrijden_verloren =  $team2->wedstrijden_verloren +1;
            } else {
                $team2->wedstrijden_gelijk = $team2->wedstrijden_gelijk + 1;
                $team2->punten = $team2->punten + 1;
            }
            $team2->doelsaldo = $team2->goalen_voor - $team2->goalen_tegen;
            $team2->aantal_wedstrijden = $team2->aantal_wedstrijden + 1;
            $team2->save();

            $wedstrijd              = new wedstrijden;
            if($request->team1_score !== ""){
                $wedstrijd->team2_score = $request->team2_score;  
                $wedstrijd->team1_score = $request->team1_score;  
            }
            $wedstrijd->team1_id    = $request->team1;
            $wedstrijd->team2_id    = $request->team2;
            $wedstrijd->gespeeld_op = $request->gespeeld_op;
            $wedstrijd->status      = $status;
            $wedstrijd->save();

            return redirect(route('wedstrijden.index'));
        
       
        } else {
            $this->validate($request, [
                'team1'=> 'required | different:team2',
                'team2'=> 'required | different:team1',
                'gespeeld_op' => 'required | date | after:yesterday'
                ]);
            $status = 0;
        }

        $wedstrijd              = new wedstrijden;
        $wedstrijd->id          = $request->id;
        $wedstrijd->team1_id    = $request->team1;
        if($request->team1_score !== ""){
        $wedstrijd->team2_score = $request->team2_score;  
        $wedstrijd->team1_score = $request->team1_score;  
        }
        $wedstrijd->team2_id    = $request->team2;
        $wedstrijd->gespeeld_op = $request->gespeeld_op;
        $wedstrijd->status      = $status;

        $wedstrijd->save();
        return redirect(route('wedstrijden.index'));
    }

    public function show($id)
    {

        $wedstrijd = wedstrijden::find($id);
        $teams = teams::all();
        return view('admin.wedstrijden.edit', compact('wedstrijd', 'teams'));
    }

    public function edit($id)
    {
        $teams = teams::all();
        $wedstrijd = wedstrijden::where('id', $id)->first();
        return view('admin.wedstrijden.edit', compact('wedstrijd', 'teams'));
    }

    public function update(Request $request, $id)
    {
        if(isset($request->status))
        {
                $this->validate($request, [
                    'team1'=> 'required | different:team2',
                    'team2'=> 'required | different:team1',
                    'team1_score' => 'required | integer | min:0',
                    'team2_score' => 'required | integer | min:0',
                    'gespeeld_op' => 'required | date | before:tomorrow'
                    ]);
                $status = 1;                               

           $team1 = teams::where('id', $request->team1)->first();
           $team2 = teams::where('id', $request->team2)->first();

            $wedstrijd = wedstrijden::where('id', $id)->first();
            if($wedstrijd->status == 0){
                $team1->aantal_wedstrijden = $team1->aantal_wedstrijden + 1;
                $team2->aantal_wedstrijden = $team2->aantal_wedstrijden + 1;
            } 
                
            
            $team1->goalen_voor  = $team1->goalen_voor - $wedstrijd->team1_score;
            $team1->goalen_voor  = $team1->goalen_voor + $request->team1_score;
            $team1->goalen_tegen = $team1->goalen_tegen - $wedstrijd->team2_score;
            $team1->goalen_tegen = $team1->goalen_tegen + $request->team2_score;
            if(($wedstrijd->team2_score < $wedstrijd->team1_score) && ($wedstrijd->status == 1) ){
                $team1->punten = $team1->punten - 3;
                $team1->wedstrijden_gewonnen = $team1->wedstrijden_gewonnen - 1;
                $team2->wedstrijden_verloren = $team2->wedstrijden_verloren - 1;
            } elseif(($wedstrijd->team2_score > $wedstrijd->team1_score) && ($wedstrijd->status == 1) ){
                $team2->punten = $team2->punten - 3;
                $team2->wedstrijden_gewonnen = $team2->wedstrijden_gewonnen - 1;
                $team1->wedstrijden_verloren = $team1->wedstrijden_verloren - 1;
            } elseif (($wedstrijd->team2_score == $wedstrijd->team1_score) && ($wedstrijd->status == 1)){
                $team1->punten = $team1->punten - 1;
                $team1->wedstrijden_gelijk = $team1->wedstrijden_gelijk - 1;
                $team2->punten = $team2->punten - 1;
                $team2->wedstrijden_gelijk = $team2->wedstrijden_gelijk - 1;
            }
            if($request->team1_score > $request->team2_score){
                $team1->wedstrijden_gewonnen = $team1->wedstrijden_gewonnen + 1;
                $team1->punten = $team1->punten + 3;
            } elseif ($request->team1_score < $request->team2_score) {
                $team1->wedstrijden_verloren =  $team1->wedstrijden_verloren +1;
            } else {
                $team1->wedstrijden_gelijk = $team1->wedstrijden_gelijk + 1;
                $team1->punten = $team1->punten + 1;
            }
            $team1->doelsaldo = $team1->goalen_voor - $team1->goalen_tegen;
            $team1->save();

            $team2->goalen_voor = $team2->goalen_voor - $wedstrijd->team2_score;
            $team2->goalen_voor = $team2->goalen_voor + $request->team2_score;
            $team2->goalen_tegen =  $team2->goalen_tegen - $wedstrijd->team1_score;
            $team2->goalen_tegen = $team2->goalen_tegen + $request->team1_score;
            if($request->team2_score > $request->team1_score){
                $team2->wedstrijden_gewonnen = $team2->wedstrijden_gewonnen + 1;
                $team2->punten = $team2->punten + 3;
            } elseif ($request->team2_score < $request->team1_score) {
                $team2->wedstrijden_verloren =  $team2->wedstrijden_verloren +1;
            } else {
                $team2->wedstrijden_gelijk = $team2->wedstrijden_gelijk + 1;
                $team2->punten = $team2->punten + 1;
            }
            $team2->doelsaldo = $team2->goalen_voor - $team2->goalen_tegen;
            $team2->save();

            $wedstrijd = wedstrijden::where('id', $id)->first();
            if($request->team1_score !== ""){
                $wedstrijd->team2_score = $request->team2_score;  
                $wedstrijd->team1_score = $request->team1_score;  
            }
            $wedstrijd->team1_id    = $request->team1;
            $wedstrijd->team2_id    = $request->team2;
            $wedstrijd->gespeeld_op = $request->gespeeld_op;
            $wedstrijd->status      = $status;
            $wedstrijd->save();
            
                opmerkingen::where('wedstrijdens_id', $id)->delete();

            return redirect(route('wedstrijden.index'));
        
       
        } else {
            $this->validate($request, [
                'team1'=> 'required | different:team2',
                'team2'=> 'required | different:team1',
                'gespeeld_op' => 'required | date | after:yesterday'
                ]);
            $status = 0;

        $team1 = teams::where('id', $request->team1)->first();
        $team2 = teams::where('id', $request->team2)->first();        
        $wedstrijd = wedstrijden::where('id', $id)->first();
     
        if ($wedstrijd->status == 1){

            opmerkingen::where('wedstrijdens_id', $id)->delete();
            if( $wedstrijd->team2_score < $wedstrijd->team1_score ){
                $team1->punten = $team1->punten - 3;
                $team1->wedstrijden_gewonnen = $team1->wedstrijden_gewonnen - 1;
                $team2->wedstrijden_verloren = $team2->wedstrijden_verloren - 1;
            } elseif($wedstrijd->team2_score > $wedstrijd->team1_score){
                $team2->punten = $team2->punten - 3;
                $team2->wedstrijden_gewonnen = $team2->wedstrijden_gewonnen - 1;
                $team1->wedstrijden_verloren = $team1->wedstrijden_verloren - 1;
            } elseif ($wedstrijd->team2_score == $wedstrijd->team1_score){
                $team1->punten = $team1->punten - 1;
                $team1->wedstrijden_gelijk = $team1->wedstrijden_gelijk - 1;
                $team2->punten = $team2->punten - 1;
                $team2->wedstrijden_gelijk = $team2->wedstrijden_gelijk - 1;
            }
            $team1->goalen_voor = $team1->goalen_voor - $wedstrijd->team1_score;
            $team1->goalen_tegen = $team1->goalen_tegen - $wedstrijd->team2_score;
            $team2->goalen_voor = $team2->goalen_voor - $wedstrijd->team2_score;
            $team2->goalen_tegen = $team2->goalen_tegen - $wedstrijd->team1_score;
            $team1->aantal_wedstrijden = $team1->aantal_wedstrijden - 1;
            $team2->aantal_wedstrijden = $team2->aantal_wedstrijden - 1;
            $team1->doelsaldo = $team1->goalen_voor - $team1->goalen_tegen;
            $team2->doelsaldo = $team2->goalen_voor - $team2->goalen_tegen;
            $team1->save();
            $team2->save();
        }
        if($request->team1_score !== ""){
        $wedstrijd->team2_score = $request->team2_score;  
        $wedstrijd->team1_score = $request->team1_score;  
        }
        $wedstrijd->team1_id    = $request->team1;
        $wedstrijd->team2_id    = $request->team2;
        $wedstrijd->gespeeld_op = $request->gespeeld_op;
        $wedstrijd->status      = $status;
        $wedstrijd->save();

        return redirect(route('wedstrijden.index'));
    }
    }

    public function destroy($id)
    {
        // if(opmerkingen::where('wedstrijdens_id', $id)){
        //         $opm = opmerkingen::where('wedstrijdens_id', $id)->get();
        //         $spelers = spelers::all();
        //         return $opm; dd();
        //         foreach($opm as $om){ 
                    
        //             foreach($spelers as $speler){
        //                 if($speler->naam == $om->gescoord_door ){
        //                 $speler->doelpunten_saldo = $speler->doelpunten_saldo - $om->aantal_gescoord;
        //                 $speler->save();
        //                 }
        //             }    
        //         }
        //     }  
        $request = wedstrijden::where('id', $id)->first();
        
        $team1 = teams::where('id', $request->team1_id)->first();
        $team2 = teams::where('id', $request->team2_id)->first();
        if($request->status == 1){

        $team1->goalen_voor = $team1->goalen_voor - $request->team1_score;
        $team1->goalen_tegen = $team1->goalen_tegen - $request->team2_score;
        if($request->team1_score > $request->team2_score){
            $team1->wedstrijden_gewonnen = $team1->wedstrijden_gewonnen - 1;
            $team1->punten = $team1->punten - 3;
        } elseif ($request->team1_score < $request->team2_score) {
            $team1->wedstrijden_verloren =  $team1->wedstrijden_verloren - 1;
        } else {
            $team1->wedstrijden_gelijk = $team1->wedstrijden_gelijk - 1;
            $team1->punten = $team1->punten - 1;
        }
        $team1->doelsaldo = $team1->goalen_voor - $team1->goalen_tegen;
        $team1->aantal_wedstrijden = $team1->aantal_wedstrijden - 1;
        $team1->save();

        $team2->goalen_voor = $team2->goalen_voor - $request->team2_score;
        $team2->goalen_tegen = $team2->goalen_tegen - $request->team1_score;
        if($request->team2_score > $request->team1_score){
            $team2->wedstrijden_gewonnen = $team2->wedstrijden_gewonnen - 1;
            $team2->punten = $team2->punten - 3;
        } elseif ($request->team2_score < $request->team1_score) {
            $team2->wedstrijden_verloren =  $team2->wedstrijden_verloren - 1;
        } else {
            $team2->wedstrijden_gelijk = $team2->wedstrijden_gelijk - 1;
            $team2->punten = $team2->punten - 1;
        }
        $team2->doelsaldo = $team2->goalen_voor - $team2->goalen_tegen;
        $team2->aantal_wedstrijden = $team2->aantal_wedstrijden - 1;
        $team2->save();
        } 

        opmerkingen::where('wedstrijdens_id', $id)->delete();
        wedstrijden::where('id', $id)->delete();
        return redirect()->back();
    }

    public function opmerkingen($id)
    {
       $wedstrijd = wedstrijden::where('id', $id)->first();
       $spelers1 = spelers::where('teams_id', $wedstrijd->team1_id)->get();
       $spelers2 = spelers::where('teams_id', $wedstrijd->team2_id)->get();
       return view('admin/wedstrijden/opmerkingen', compact('wedstrijd', 'spelers1', 'spelers2'));
    }
}
