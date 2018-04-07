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
       $spelers1 = spelers::where('teams_id', $wedstrijd->team1_id)->get();
       $spelers2 = spelers::where('teams_id', $wedstrijd->team2_id)->get();

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
                if($speler->naam == $request->gescoord_door[$i] ){
                $speler->doelpunten_saldo = $speler->doelpunten_saldo + $request->aantal_gescoord[$i];
                $speler->save();
                }
            }
            $opmerkingen = new opmerkingen;
            $opmerkingen->wedstrijdens_id = $request->id;
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

    // public function edit($id)
    // {
    //    $wedstrijd = wedstrijden::where('id', $id)->first();
    //    $spelers1 = spelers::where('ploeg_naam', $wedstrijd->team1_id)->get();
    //    $spelers2 = spelers::where('ploeg_naam', $wedstrijd->team2_id)->get();
    //    $opmerkingen = opmerkingen::where('wedstrijden_id', $wedstrijd->id)->get();
      
    //    return view('admin/wedstrijden/opmerkingenedit', compact('wedstrijd', 'spelers1', 'spelers2', 'opmerkingen'));
    // }

    // public function update(Request $request, $id)
    // {
    //     if(((count($request->wissel)) >= (count($request->gele_kaarten))) && ((count($request->wissel)) >= (count($request->rode_kaarten))) && ((count($request->wissel)) >= (count($request->gescoord_door))) ){
    //         $max = count($request->wissel);
    //     } elseif (((count($request->gele_kaarten)) >= (count($request->wissel))) && ((count($request->gele_kaarten)) >= (count($request->rode_kaarten))) && ((count($request->gele_kaarten)) >= (count($request->gescoord_door))) ){
    //         $max= count($request->gele_kaarten);
    //     } elseif(((count($request->gescoord_door)) >= (count($request->wissel))) && ((count($request->gescoord_door)) >= (count($request->rode_kaarten))) && ((count($request->gescoord_door)) >= (count($request->gele_kaarten))) ){
    //         $max= count($request->gescoord_door);
    //     } else {
    //         $max = count($request->rode_kaarten);
    //     }

    //    for ($i=0; $i < $max  ; $i++) { 
    //         opmerkingen::where('wedstrijden_id', $id)->delete();
    //         $opmerkingen = new opmerkingen;
    //         $opmerkingen->wedstrijden_id = $request->id;
    //         if (($request->gele_kaarten[$i] !== null) && ($request->aantal_geel[$i] !== null) ){
    //             $opmerkingen->gele_kaarten = $request->gele_kaarten[$i];
    //             $opmerkingen->aantal_geel  = $request->aantal_geel[$i];
    //         }
    //         if (($request->gescoord_door[$i] !== null) && ($request->aantal_gescoord[$i] !== null) ){
    //             $opmerkingen->gescoord_door = $request->gescoord_door[$i];
    //             $opmerkingen->aantal_gescoord  = $request->aantal_gescoord[$i];
    //         }
    //         if ($request->rode_kaarten[$i] !== null){
    //             $opmerkingen->rode_kaarten = $request->rode_kaarten[$i];
    //         }
    //         if (($request->wissel[$i] !== null) && ($request->wissel_speler[$i] !== null) ){
    //             $opmerkingen->wissel = $request->wissel[$i];
    //             $opmerkingen->wissel_speler  = $request->wissel_speler[$i];
    //         }
    //         $opmerkingen->save();
    //     }       

    //     // voor de view
    //     //foreach (wedstrijd->id == $opmerkingen->wedstrijd_id) en (dit word eigenlijk al opgevangen voor de store) if(value !== null)   { echo data }
        
        
    //     return redirect(route('wedstrijden.index'));
    // }

    public function destroy($id)
    {   
        $opm = opmerkingen::where('wedstrijdens_id', $id)->get();
        foreach($opm as $om){ 
        $spelers = spelers::all();
        foreach($spelers as $speler){
            if($speler->naam == $om->gescoord_door ){
            $speler->doelpunten_saldo = $speler->doelpunten_saldo - $om->aantal_gescoord;
            $speler->save();
            }
        }    
        }           
        opmerkingen::where('wedstrijdens_id', $id)->delete();
        return redirect()->back();
    }
}
