@extends('admin/layouts/app')
@section('headSection')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script>
   // $('document').ready(function(){})
   // window.onload = () =>{
  // de variabelen voor de checkWissel functies 
   var wissel1 = document.getElementsByName('opt1');
   var wissel2 = document.getElementsByName('opt2');
   var i = 0;
   var y = 0;
 // }
   // indien er iemand uit team1 word geselecteerd dan laten we bij de wissels alleen spelers zien uit opt1 (team1) en de andere opt blijft onzichtbaar
   // alsook moet er een soort nummering zijn om door de array van wissel1 en wissel2 te loopen
   // deze nummering word ook verminderd van waarde indien er een element word gedelete, zie(functie remove_random_functie_naam)
   // die if stond eerst als if ( i < 3 ) maar dat gaf errors doordat i ook in de checkwissel2 word geincrementeerd,
   // en dat is nodig om de array value juist te hebben, wissel[i] 
  function checkWissel1(){
    if( i < 6 ){
      wissel1[i].style.display = "block";
      wissel2[i].style.display = "none";
      } else { 
      alert('Je kan maximum 3 invallers hebben per team. Gelieve dit aan te passen');
      {
        event.preventDefault();
      }
      // dit werkt nog niet 
      // remove_random_functie_naam('+ i +');
    }
  } 
  
  function checkWissel2(){ 
    if( i < 6 ){
      wissel1[i].style.display = "none";
      wissel2[i].style.display = "block";
    } else {
       alert('Je kan maximum 3 invallers hebben per team. Gelieve dit aan te passen');
       {
         event.preventDefault();
       }
       // remove_random_functie_naam('+ i +')
    }
  }

  // check scores en set max
  // variablen declareren voor de functies
  //queryselector gebruikt op advies van discord traversy
  var score1 = {!! json_encode($wedstrijd->team1_score)!!};
  var score2 = {!! json_encode($wedstrijd->team2_score)!!};
  var goal = document.getElementsByClassName("score form-control");
  var opt3 = document.getElementsByName('opt3');
  var opt4 = document.getElementsByName('opt4');
  var d = 0;
  var s1;

  // de max value zetten (tov het aantal doelpunten al gescoord in de wedstrijd en de goalen die al ingevuld zijn)
  function scoreMax(){
     goal[d].setAttribute("max", +score1);
  }
  function scoreMax1(){
      goal[d].setAttribute("max", +score2);
  }
  //functie om een team te tonen om de goalen in te vullen (als team1 gescoord heeft begint team1 met invullen)
   function showHide(){
      if(score1 > 0){  
          // vorige value van opslaan en aftrekken van de score om zo het totaal van de team score te herberekenen die nog kan worden ingevoerd
          s1 = goal[d].value;
          score1 = score1 - s1;
           d++;
           goal[d].setAttribute("max", +score1); //fix
           // zichtbaar/onzichtbaar maken van de optgroups, zodat enkel team2 zichtbaar is wanneer team1 al zijn goalen heeft ingevuld
           if(score1 == 0){
              opt4[d].style.display='block';
              opt3[d].style.display='none';
              goal[d].setAttribute("max", +score2);  //fix
              if(score2 == 0){
                 if(confirm('Je hebt alle scores al ingegeven, Heb je een fout gemaakt?') ){
                  location.reload(); 
                 }else{
                  event.preventDefault();
                 } 
              }
           }else{
            // onzichtbaar houden van de optgroup zolang dat team1 nog goalen moet invullen
              opt4[d].style.display='none';
          }
      } else {
          s1 = goal[d].value;
          score2 = score2 - s1;
          d++;
          goal[d].setAttribute("max", +score2) //fix
          opt3[d].style.display='none';
          if(score2 == 0 ){
              if(confirm('Je hebt alle scores al ingegeven, Heb je een fout gemaakt?') ){
                  location.reload(); 
              }else{
                event.preventDefault();
              } 
              // ik zou graag indien confirmed alle divs hier deleten en alle values terug op 0 zetten en indien cancel enkel de laatste div deleten
          }
      }
  }

  //de loop nummering declareren
  var broom = 1;
  var room = 1;
  var vroom= 1;
//de functie die ervoor zorgt dat er velden bij komen als je aantal gele kaarten gele kaarten op de groene plus duwt en dat alles genummert word
// bron : jsfiddle.net yonet3d
// wel zelf gecustomized voor mijn app
function education_fields() {
 
    room++;
    var objTo = document.getElementById('education_fields')
    var divtest = document.createElement("div");
  divtest.setAttribute("class", "form-group removeclass"+room);
  var rdiv = 'removeclass'+room;
    divtest.innerHTML = '<div class="row"><div class="col-sm-3 nopadding"> <div class="form-group"> <select class="form-control" name="gele_kaarten[]" data-placeholder="Selecteer een speler" style="width: 100%;"><option disabled hidden selected>gele kaarten</option> <optgroup label="{{ $wedstrijd->teams[0]->naam }}"> @foreach ($wedstrijd->teams[0]->spelers as $speler) <option>{{$speler->naam}}</option> @endforeach <optgroup label="{{ $wedstrijd->teams[1]->naam }}"> @foreach ($wedstrijd->teams[1]->spelers as $speler) <option>{{$speler->naam}}</option> @endforeach </select></div></div><div class="col-sm-3 nopadding"><div class="input-group"><input type="number" class="form-control" id="geel" name="aantal_geel[]" min="0" max="2"  placeholder="aantal"><div class="input-group-btn"><button class="btn btn-success" type="button"  onclick="education_fields();"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button><button class="btn btn-danger" type="button" onclick="remove_education_fields('+ room +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div></div></div><div class="clear"></div></div>';
    
    objTo.appendChild(divtest)
}
// de delete functie , en de nummering telt af zodat je geen sprongen krijgt zodat het uitlezen van de variabelen geen null waarden tussen bepaalde values heeft.
   function remove_education_fields(rid) {
    room--;
     $('.removeclass'+rid).remove();
   }

function education_magic() {
 
    broom++;
    var objTo = document.getElementById('education_magic')
    var divtest = document.createElement("div");
  divtest.setAttribute("class", "form-group vanishfunctie"+broom);
  var rdiv = 'vanishfunctie'+broom;
    divtest.innerHTML = '<div class="row"><div class="col-md-offset-3 col-sm-3 nopadding"><div class="form-group"><select class="form-control" name="gescoord_door[]" style="width: 100%;"><option disabled hidden selected>gescoord door</option><optgroup name="opt3" onclick="scoreMax()" label="{{ $wedstrijd->teams[0]->naam }}" @if($wedstrijd->team1_score == 0) hidden @endif > @foreach ($wedstrijd->teams[0]->spelers as $speler)<option>{{$speler->naam}}</option> @endforeach </optgroup><optgroup name="opt4" onclick="scoreMax1()" label="{{ $wedstrijd->teams[1]->naam }}" @if($wedstrijd->team2_score == 0) hidden @endif > @foreach ($wedstrijd->teams[1]->spelers as $speler) <option>{{$speler->naam}}</option> @endforeach </optgroup></select></div></div><div class="col-sm-3 nopadding"><div class="input-group"><input type="number" class="score form-control" name="aantal_gescoord[]" min="0" placeholder="aantal"><div class="input-group-btn"><button class="btn btn-success" type="button"  onclick="education_magic(); showHide();"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></div></div></div></div><div class="clear"></div></div>';
    
    objTo.appendChild(divtest)
}

function random_functie_naam() {
        i++;
        vroom++;
        var objTo = document.getElementById('random_functie_naam')
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "form-group randomnaam"+vroom);
        var rdiv = 'randomnaam'+vroom;

         divtest.innerHTML = '<div class="row"><div class="col-md-offset-3 col-sm-3 nopadding"><div class="form-group"><select class="form-control" name="wissel[]" id="wissel" style="width: 100%;"><option disabled hidden selected>Gewisseld</option><optgroup onclick="checkWissel1()" label="{{ $wedstrijd->teams[0]->naam }}"> @foreach ($wedstrijd->teams[0]->spelers as $speler) <option>{{$speler->naam}}</option> @endforeach </optgroup><optgroup onclick="checkWissel2()" label="{{ $wedstrijd->teams[1]->naam }}"> @foreach ($wedstrijd->teams[1]->spelers as $speler) <option>{{$speler->naam}}</option> @endforeach </optgroup></select></div></div><div class="col-sm-3 nopadding"><div class="input-group" ><select class="form-control" name="wissel_speler[]" id="gewisseld" style="width: 100%;"><option disabled hidden selected>Gewisseld voor</option><optgroup name="opt1" label="{{ $wedstrijd->teams[0]->naam }}"> @foreach ($wedstrijd->teams[0]->spelers as $speler) <option>{{$speler->naam}}</option> @endforeach </optgroup><optgroup name="opt2" label="{{ $wedstrijd->teams[1]->naam }}"> @foreach ($wedstrijd->teams[1]->spelers as $speler) <option>{{$speler->naam}}</option> @endforeach </optgroup></select><div class="input-group-btn"><button class="btn btn-success" type="button"  onclick="random_functie_naam();"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button><button class="btn btn-danger" type="button" onclick="remove_random_functie_naam('+ vroom +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div></div></div><div class="clear"></div></div>';
        
        objTo.appendChild(divtest)
   }
function remove_random_functie_naam(rid) {
      y--;
      i--;
      vroom--;
      $('.randomnaam'+rid).remove();
   }
</script>
<style>
.select2-results__option
{
  font-size: 12px;
}
.select2-results__group
{
  background-color: #F5F5F5;
}

#mooi {
  border-radius: 5px;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice {
  background-color:red;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
  color:white;
}
</style>
@endsection

@section('main-content')
@if((App\Model\admin\admin::where('seizoen', 0)->first()))
<div class="content-wrapper">
  <div class="box box-default">
    <div class="box-header with-border" style='text-align:center'>
      <ol class="breadcrumb">
        <li><a href="{{route('wedstrijden.index')}}">Wedstrijden</a></li>
        <li><a href="{{route('opmerkingen', $wedstrijd->id)}}">Opmerkingen</a></li>
      </ol>
      <h3 class="box-title">Opmerkingen bij {{$wedstrijd->teams[0]->naam}} {{ $wedstrijd->team1_score }} - {{ $wedstrijd->team2_score }} {{$wedstrijd->teams[1]->naam}}</h3>
     <!-- /.box-header -->
    </div>
    @include('includes.messages')
    <form name='try' role="form" action="{{ route('opmerkingen.store', $wedstrijd->id) }}" method='post'>
    <!-- na het openen van elke form in laravel moet je een csrf_field  -->
    {{ csrf_field() }}
    {{ method_field('post') }}
      <div class="box-body">
        <div class="row" style='padding-bottom: 15px;'>
          <h3 style='text-align:center;'>Goals</h3>
          <br>
          <div class="col-md-offset-3 col-sm-3 nopadding">
            <div class="form-group">
              <select class="form-control" name="gescoord_door[]" style="width: 100%;">
                <option hidden selected value= >gescoord door</option>
                <optgroup name="opt3"  label="{{ $wedstrijd->teams[0]->naam }}" @if($wedstrijd->team1_score == 0) hidden @endif >
                @foreach ($wedstrijd->teams[0]->spelers as $speler)
                  <option onclick="scoreMax()">{{$speler->naam}}</option>
                @endforeach
                </optgroup>
                <optgroup name="opt4"  label="{{ $wedstrijd->teams[1]->naam }}" @if(($wedstrijd->team2_score == 0) or ($wedstrijd->team1_score > 0)) hidden @endif >
                @foreach ($wedstrijd->teams[1]->spelers as $speler)
                  <option onclick='scoreMax1()'>{{$speler->naam}}</option>
                @endforeach
                </optgroup>
              </select>
            </div>
          </div>
          <div class="col-sm-3 nopadding" >
            <div class="input-group">
              <input type="number" class="score form-control" name="aantal_gescoord[]" min="0" @if($wedstrijd->team1_score == 0) max='{{$wedstrijd->team2_score}}'  @else max='{{$wedstrijd->team1_score}}' @endif placeholder="aantal" value= >
              <div class="input-group-btn">
                <button class="btn btn-success" type="button"  onclick="education_magic(); showHide();">
                  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="clear"></div>
        <div id="education_magic"></div>
        <h3 style='text-align:center;'>Kaarten</h3>
        <br>
      <!-- padding bijgeplaatst zodat de extra input velden op dezelfde afstand van elkaar zijn -->
        <div class="row" style='padding-bottom: 15px;'>
          <div class="col-sm-3 nopadding">
            <div class="form-group">
              <!-- een array aanmaken die de namen van de spelers die geel krijgen als value heeft -->
              <select class="form-control" name='gele_kaarten[]' data-placeholder="Selecteer een speler" style="width: 100%;">
                <!-- bij gebrek aan een beter idee doe ik mijn placeholder zo -->
                <option hidden selected value= >gele kaarten</option>
                <optgroup label="{{ $wedstrijd->teams[0]->naam }}">
                @foreach ($wedstrijd->teams[0]->spelers as $speler)
                  <option>{{$speler->naam}}</option>
                @endforeach
                </optgroup>
                <optgroup label="{{ $wedstrijd->teams[1]->naam }}">
                @foreach ($wedstrijd->teams[1]->spelers as $speler)
                  <option>{{$speler->naam}}</option>
                @endforeach
                </optgroup>
              </select>
            </div>
          </div>
          <div class="col-sm-3 nopadding">
            <div class="input-group">
              <input type="number" class="form-control" id="geel" name="aantal_geel[]" min="0" max="2" placeholder="aantal" value=>
              <div class="input-group-btn">
                <!-- oproepen van de functie die de velden dupliceert -->
                <button class="btn btn-success" type="button"  onclick="education_fields();">
                  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </button>
              </div>
            </div>
          </div>
          <div class="clear"></div>
          <div class="col-md-offset-1 col-md-4">
            <div class="form-group">
              <select class="form-control select2" multiple="multiple" id="mooi" name='rode_kaarten[]' style="width: 100%;" >
                <option hidden selected value= >Geen Rode Kaarten </option>
                <optgroup label="{{ $wedstrijd->teams[0]->naam }}">
                @foreach ($wedstrijd->teams[0]->spelers as $speler)
                  <option>{{$speler->naam}}</option>
                @endforeach
                </optgroup>
                <optgroup label="{{ $wedstrijd->teams[1]->naam }}">
                @foreach ($wedstrijd->teams[1]->spelers as $speler)
                  <option>{{$speler->naam}}</option>
                @endforeach
                </optgroup>
              </select>
            </div>
          </div>
        </div>
        <div id="education_fields"></div>
        <div class="row" style='padding-bottom: 15px;'>
          <h3 style='text-align:center;'>Wissels</h3>
          <br>
          <div class="col-md-offset-3 col-sm-3 nopadding">
            <div class="form-group">
              <select class="form-control" name="wissel[]" id='wissel'  style="width: 100%;">
                <option hidden selected value= >Gewisseld</option>
                <!-- onclick functie om alleen de wisselspelers van hetzelfde team te tonen -->
                <optgroup onclick="checkWissel1()" label="{{ $wedstrijd->teams[0]->naam }}">
                @foreach ($wedstrijd->teams[0]->spelers as $speler)
                  <option>{{$speler->naam}}</option>
                @endforeach
                </optgroup>
                <optgroup onclick="checkWissel2()" label="{{ $wedstrijd->teams[1]->naam }}">
                @foreach ($wedstrijd->teams[1]->spelers as $speler)
                  <option>{{$speler->naam}}</option>
                @endforeach
                </optgroup>
              </select>
            </div>
          </div>
          <div class="col-sm-3 nopadding">
            <div class="input-group" >
              <select class="form-control" name="wissel_speler[]" id='gewisseld' style="width: 100%;">
                <option hidden selected value= >Gewisseld voor</option>
                <optgroup name='opt1' label="{{ $wedstrijd->teams[0]->naam }}">
                @foreach ($wedstrijd->teams[0]->spelers as $speler)
                  <option>{{$speler->naam}}</option>
                @endforeach
                </optgroup>
                <optgroup name='opt2' label="{{ $wedstrijd->teams[1]->naam }}">
                @foreach ($wedstrijd->teams[1]->spelers as $speler)
                  <option>{{$speler->naam}}</option>
                @endforeach
                </optgroup>
              </select>
              <div class="input-group-btn">
                <button class="btn btn-success" type="button"  onclick="random_functie_naam();"> 
                  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="clear"></div>
        <div id="random_functie_naam"></div>
<!-- Indien ik deze code wil gebruiken moet ik de database en de controller wel aanpassen alsook een andere naam geven aan wissel team 2,
  Maar dit is een mogelijke oplossing voor mijn probleem dat ik had in alle browsers behalve mozilla namelijk dat mijn checkwissel functie niet werd getriggerd.
                  <div class="row" style='padding-bottom: 15px;'>
                    <h3 style='text-align:center;'>Wissels {{$wedstrijd->teams[0]->naam}}</h3>
                    <br>
                    <div class="col-md-offset-3 col-sm-3 nopadding">
                      <div class="form-group">
                        <select class="form-control" name="wissel[]" id='wissel'  style="width: 100%;">
                          @foreach ($wedstrijd->teams[0]->spelers as $speler)
                            <option>{{$speler->naam}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-3 nopadding">
                      <div class="input-group" >
                        <select class="form-control" name="wissel_speler[]" id='gewisseld' style="width: 100%;">
                          <option hidden selected value= >Gewisseld voor</option>
                          @foreach ($wedstrijd->teams[0]->spelers as $speler)
                            <option>{{$speler->naam}}</option>
                          @endforeach
                        </select>
                        <div class="input-group-btn">
                          <button class="btn btn-success" type="button"  onclick="random_functie_naam();"> 
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="clear"></div>
                  <div id="random_functie_naam"></div>

                  <div class="row" style='padding-bottom: 15px;'>
                    <h3 style='text-align:center;'>Wissels {{$wedstrijd->teams[1]->naam}}</h3>
                    <br>
                    <div class="col-md-offset-3 col-sm-3 nopadding">
                      <div class="form-group">
                        <select class="form-control" name="wissel[]" id='wissel'  style="width: 100%;">
                          @foreach ($wedstrijd->teams[1]->spelers as $speler)
                            <option>{{$speler->naam}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-3 nopadding">
                      <div class="input-group" >
                        <select class="form-control" name="wissel_speler[]" id='gewisseld' style="width: 100%;">
                          <option hidden selected value= >Gewisseld voor</option>
                          @foreach ($wedstrijd->teams[1]->spelers as $speler)
                            <option>{{$speler->naam}}</option>
                          @endforeach
                        </select>
                        <div class="input-group-btn">
                          <button class="btn btn-success" type="button"  onclick="random_functie_naam();"> 
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="clear"></div>
                  <div id="random_functie_naam"></div> -->
      </div>
      <!-- verborgen input zodat de wedstrijd id ook word meegestuurd -->
      <input class="hidden" name='id' value='{{$wedstrijd->id}}'>  
      <div class="box-footer" style='text-align: center;'>
        <button type="submit" class="btn btn-primary">Verzenden</button>
        <a type="button" href="" class="btn btn-warning">Terug</a>
      </div>
    </form>
  </div>
</div>
@else 
<div class="content-wrapper">
  <!-- general form elements -->
  <div class="box box-primary">
    <div class='well' style='text-align:center; background-color:red'>
      Het seizoen is geëindigd en dus is het niet mogelijk om wedstrijd details in te vullen.
    </div>
  </div>
</div>
@endif
@endsection
@section('footerSection')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>

  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    
  })
</script>
@endsection