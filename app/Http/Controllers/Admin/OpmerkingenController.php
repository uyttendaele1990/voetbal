<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\admin\teams;
use Illuminate\Support\Facades\Storage;
use App\Model\admin\opmerkingen;
use App\Model\admin\wedstrijden;
use App\Model\admin\spelers;

class OpmerkingenController extends Controller
{

    public function create($id)
    { 
       $wedstrijd = wedstrijden::where('id', $id)->first();
       $spelers1 = spelers::where('teams_id', $wedstrijd->teams[0]->id)->get();
       $spelers2 = spelers::where('teams_id', $wedstrijd->teams[1]->id)->get();

       return view('admin/wedstrijden/opmerkingen', compact('wedstrijd', 'spelers1', 'spelers2'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
                    // 'id' => 'required',
                    // 'gele_kaarten' => 'nullable | string',
                    // 'aantal_geel' => 'nullable | integer',
                    // 'gescoord_door' => 'nullable |string',
                    // 'aantal_gescoord' => 'nullable | integer',
                    // 'rode_kaarten' => 'nullable | string',
                    // 'wissel' => 'nullable | string',
                    // 'wissel_speler' => 'nullable | string'
                    ]);
        if(((count($request->wissel)) >= (count($request->gele_kaarten))) && ((count($request->wissel)) >= (count($request->rode_kaarten))) && ((count($request->wissel)) >= (count($request->gescoord_door))) ){
            $max = count($request->wissel);
        } elseif (((count($request->gele_kaarten)) >= (count($request->wissel))) && ((count($request->gele_kaarten)) >= (count($request->rode_kaarten))) && ((count($request->gele_kaarten)) >= (count($request->gescoord_door))) ){
            $max= count($request->gele_kaarten);
        } elseif(((count($request->gescoord_door)) >= (count($request->wissel))) && ((count($request->gescoord_door)) >= (count($request->rode_kaarten))) && ((count($request->gescoord_door)) >= (count($request->gele_kaarten))) ){
            $max= count($request->gescoord_door);
        } else {
            $max = count($request->rode_kaarten);
        }

       for ($i=0; $i < $max  ; $i++) { 
            $spelers= spelers::all();
            foreach($spelers as $speler){
                if (isset($request->gescoord_door[$i]) && (isset($request->aantal_gescoord[$i]))){
                if($speler->naam == $request->gescoord_door[$i] ){
                $speler->doelpunten_saldo = $speler->doelpunten_saldo + $request->aantal_gescoord[$i];
                $speler->save();
                }
            }
            }
            $opmerkingen = new opmerkingen;
            $opmerkingen->wedstrijden_id = $request->id;
            if (isset($request->gele_kaarten[$i]) && (isset($request->aantal_geel[$i]))){
                $opmerkingen->gele_kaarten = $request->gele_kaarten[$i];
                $opmerkingen->aantal_geel  = $request->aantal_geel[$i];
            }
            if (isset($request->gescoord_door[$i]) && (isset($request->aantal_gescoord[$i]))){
                $opmerkingen->gescoord_door = $request->gescoord_door[$i];
                $opmerkingen->aantal_gescoord  = $request->aantal_gescoord[$i];
            }
            if (isset($request->rode_kaarten[$i])){
                $opmerkingen->rode_kaarten = $request->rode_kaarten[$i];
            }
            if (isset($request->wissel[$i]) && (isset($request->wissel_speler[$i]))){
                $opmerkingen->wissel = $request->wissel[$i];
                $opmerkingen->wissel_speler  = $request->wissel_speler[$i];
            }
            $opmerkingen->save();
        }               
        
        return redirect(route('wedstrijden.index'));
    }

    public function destroy($id)
    {   
        $opm = opmerkingen::where('wedstrijden_id', $id)->get();
        foreach($opm as $om){ 
        $spelers = spelers::all();
        foreach($spelers as $speler){
            if($speler->naam == $om->gescoord_door ){
            $speler->doelpunten_saldo = $speler->doelpunten_saldo - $om->aantal_gescoord;
            $speler->save();
            }
        }    
        }           
        opmerkingen::where('wedstrijden_id', $id)->delete();
        return redirect()->back();
    }
}
