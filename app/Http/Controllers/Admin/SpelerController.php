<?php

namespace App\Http\Controllers\Admin;
//de request 'helper' inladen
use Illuminate\Http\Request;
//de base controller inladen zodat die geëxtend kan worden en ik de basis functies kan gebruiken
use App\Http\Controllers\Controller;
//spelers model inladen zodat ik die table spelers van de db kan gebruiken
use App\Model\admin\spelers;
//teams model inladen zodat ik die table spelers van de db kan gebruiken
use App\Model\admin\teams;
//de storage functie inladen voor de fotos
use Illuminate\Support\Facades\Storage;

class SpelerController extends Controller
{

    public function index()
    {
        //alle data spelers in een variabele zetten zodat ik ze kan gebruiken in de admin.speler.show
        $spelers = spelers::all();
        // compact word gebruik om een array te creeëren van een object
        return view('admin.spelers.show', compact('spelers'));
    }

    public function create()
    {
        //alle data uit teams in variabele gestoken zodat ik ze kan gebruiken in de dropdown voor een team te selecteren
        $teams = teams::all();
        return view('admin/spelers/spelers', compact('teams'));
    }

    public function store(Request $request)
    {    
        //eerst valideren zodat de verplichte velden zeker ingevuld zijn voordt ze worden opgeslaan
        //foto validatie zorgt er voor dat je enkel een jpeg, bmp, png bestand kunt uploaden
         $this->validate($request, [
            'naam'       => 'required | unique:spelers',
            'teams_id' => 'required',
            'foto' => 'mimes:jpeg,bmp,png'
            ]);
         //indien er een foto is geüpload
         if($request->hasFile('foto')){
            // originele naam van de file behouden
            // $request->foto->getClientOriginalName();
            //de foto opslaan onder storage/app/public/foto
            $request->foto->store('public/foto');
            //de route/bestandsnaam opslaan zodat je nog met de foto kunt werken
            //de public wegdoen want onze root (voatbal.app staat al ingesteld op voetbal/public)
            $foto = $request->foto->store('foto');
         } else {
            //indien er geen foto word geüpload krijgt de user het default avatar'tje
            $foto = "foto/user-default.png";
         }
        
        
        
        //niewe array maken die we in de db kunnen steken onder de tbl spelers
        $speler = new spelers;
        //variabelen opslaan
        $speler->id         = $request->id;
        $speler->naam       = $request->naam;
        $speler->teams_id   = $request->teams_id;
        $speler->foto       = $foto;
        //de data in de db opslaan
        $speler->save();
        return redirect(route('spelers.index'));
    }

    public function edit($id)
    {
        //alle data uit teams in variabele gestoken zodat ik ze kan gebruiken in de dropdown voor een team te selecteren 
        $teams = teams::all();
        //je moet de ->first() want met ->get() zit je array in een array en kan je er weinig mee doen.
        $spelers = spelers::where('id', $id)->first();
        return view('admin/spelers/edit', compact('spelers', 'teams'));
    }

    public function update(Request $request, $id)
    {
        //eerst valideren zodat de verplichte velden zeker ingevuld zijn voordt ze worden geüpdate
        //foto validatie zorgt er voor dat je enkel een jpeg, bmp, png bestand kunt uploaden
        $this->validate($request, [
            'naam'       => 'required',
            'teams_id' => 'required',
            'foto' => 'mimes:jpeg,bmp,png'
            ]);

        //de data van de speler vinden in de db die het id heeft dat jij wil updaten
        $speler = spelers::find($id);
        // Kijken als er een foto word geüpdate indien je dit niet doet en er word niets doorgegeven krijg je een error als je store() gebruikt (blijkbaar is hasFile('..') enkel voor requests)
        if($request->hasFile('foto')){

           // Het pad van de foto die overschreven word opslaan in var
           // $foto = 'voetbal/storage/app'.url($speler->foto); 
           //de foto die overschreven word unlinken
           // unlink($foto);
           // originele naam van de file behouden
           // $request->foto->getClientOriginalName();
           // niewe foto opslaan in storage/app/public/foto
           $request->foto->store('public/foto');
           // het pad opslaan in var
           $foto = $request->foto->store('foto');
           //ff checken of de user wel een foto heeft(indien een admin een aanstootgevende foto verwijderd ofziets, want normaal gezien heeft iedereen een foto aangezien dat de validation rule in de store functie op required staat)
           if($speler->foto === null){
            }   else  {
           //de oude foto deleten
           Storage::delete($speler->foto);
           }
           // var in db var steken zodat je het pad later kunt oproepen
           $speler->foto = $foto;
           // de if beïndigen
        }   
        //data in db varaiabelen steken en opslaan
        $speler->naam     = $request->naam;     
        $speler->teams_id = $request->teams_id;
        //je kan zowel ->save(); als ->update(); gebruiken hier
        $speler->update();
        return redirect(route('spelers.index'));
    }

    public function destroy($id)
    {
         //De data van de speler deleten op basis van het id dat je gekozen hebt
        spelers::where('id', $id)->delete();
        return redirect()->back();
    }
}
