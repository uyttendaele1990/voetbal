@extends('user/layouts/app')


@section('headSection')
<style>
.navbar-brand > img:nth-child(1){
  position:relative;
  top:-15px;
}
#mainNav{
  background-color: black;
  opacity:0.8;
}
.pull-right{
  position:relative;
  top: -15px;
}
.pull-left{
  position:relative;
  top: -15px;
}
.box-body > div:nth-child(1){
  position:relative;
  padding-top: 125px;
}
header {
  display:none;
}
body {
  background-image:url('{{asset("user/img/wed12.jpg")}}');
  background-repeat: no-repeat;
  background-size: cover;
}
.well {
opacity:0.8;
border-radius:55px;
}
img.displayed {
    margin-left: auto;
    margin-right: auto;
    width:45px;
    height:45px;
    border-radius:50%; 
  }
</style>
@endsection
@section('main-content')
<!-- {{$wedstrijden}} -->
<a href="#" class='back-to-top'><i class="glyphicon glyphicon-chevron-up"></i></a>
<div class="content-wrapper" style='text-align: center;'>

  <!-- general form elements -->
  <div class='container'>
     <div class="box-body">
     @if(App\Model\admin\opmerkingen::where('wedstrijden_id', $wedstrijden->id)->first())
      <div class="row">
        <div class='col-md-5'>
           <img src="/storage/{{ $wedstrijden->teams[0]->logo }}" style='width:100px; height:100px; margin-bottom: 15px;'><label class='pull-right'  style='font-size:100px;'>{{$wedstrijden->team1_score}}</label>          
        </div>
        <div class='col-md-2'> 
           <img src="{{ asset('user/img/vs.png')}}" style='width:100px; height:100px;padding-top:25px; margin-bottom: 15px;'>
        </div>
        <div class='col-md-5'><label class='pull-left'  style='font-size:100px'>{{$wedstrijden->team2_score}}</label> 
           <img src="/storage/{{ $wedstrijden->teams[1]->logo }}" style='width:100px; height:100px; margin-bottom: 15px;'>
        </div>
      </div>
      <div class="row">
      <div class='col-md-offset-5 col-md-2 well' style='background:lightgreen; border-radius:45px; '>
        <h2 style='text-align: center;'>Goalen</h2>
      </div>
     </div>
      <br>
        <div class="row">
          <div class='well col-md-offset-1 col-md-4' style='text-align: center;''>
            <h3>{{ $wedstrijden->teams[0]->naam }}</h3>
            <hr>
            @for ($i = 0; $i < count($wedstrijden->opmerkingen); $i++)
                @if(!($wedstrijden->opmerkingen[$i]->gescoord_door == null))
                  @foreach($wedstrijden->teams[0]->spelers as $speler)
                    @if($speler->naam == $wedstrijden->opmerkingen[$i]->gescoord_door) 
                      <img class='displayed' src="/storage/{{ $speler->foto }}"><br>
                      <h3 style='margin-top:5px'>{{ $wedstrijden->opmerkingen[$i]->gescoord_door }}</h3>
                      <label style='margin-bottom: 15px'>{{ $wedstrijden->opmerkingen[$i]->aantal_gescoord }} @if($wedstrijden->opmerkingen[$i]->aantal_gescoord == 1) doelpunt @else doelpunten @endif</label><br>
                      <div hidden>{{ $check = 0 }} </div>
                    @endif
                  @endforeach
                @endif
            @endfor
            @if($check !== 0)
              <strong>niet gescoord</strong>
            @endif
            <div style hidden>{{$check= 1}} </div>
          </div>
          <div class='well col-md-offset-2 col-md-4' style='text-align: center;''>
            <h3>{{ $wedstrijden->teams[1]->naam }}</h3>
            <hr>
            @for ($i = 0; $i < count($wedstrijden->opmerkingen); $i++)
              @if(!($wedstrijden->opmerkingen[$i]->gescoord_door == null))
                @foreach($wedstrijden->teams[1]->spelers as $speler)
                  @if($speler->naam == $wedstrijden->opmerkingen[$i]->gescoord_door)
                    <img class='displayed' src="/storage/{{ $speler->foto }}"><br>
                      <h3 style='margin-top:5px'>{{ $wedstrijden->opmerkingen[$i]->gescoord_door }}</h3>
                      <label style='margin-bottom: 15px'>{{ $wedstrijden->opmerkingen[$i]->aantal_gescoord }} @if($wedstrijden->opmerkingen[$i]->aantal_gescoord == 1) doelpunt @else doelpunten @endif</label><br>
                      <div hidden> {{ $check = 0 }}</div>
                  @endif
                @endforeach 
                @endif
            @endfor
            @if($check !== 0)
              <strong>niet gescoord</strong>
            @endif
            <div style hidden>{{$check= 1}} </div>
          </div>
        </div>
        <div class="row">
      <div class='col-md-offset-5 col-md-2 well' style='background:lightgreen; border-radius:45px; '>
        <h2 style='text-align: center;'>Kaarten</h2>
      </div>
     </div>
        <div class='row'>
          <div class="well col-md-offset-1 col-md-4"> 
            <h3>{{ $wedstrijden->teams[0]->naam }}</h3>
            <hr>
            @for ($i = 0; $i < count($wedstrijden->opmerkingen); $i++)
              @foreach($wedstrijden->teams[0]->spelers as $speler)
               @if($speler->naam == $wedstrijden->opmerkingen[$i]->gele_kaarten) 
                @if(!($wedstrijden->opmerkingen[$i]->aantal_geel == null))
                 @if($wedstrijden->opmerkingen[$i]->aantal_geel == 1)
                 <img src="/user/img/geel.png" style='width:15px; height: 20px;'>
                 @elseif ($wedstrijden->opmerkingen[$i]->aantal_geel == 2)
                  <img src="/user/img/geel.png" style='width:15px; height: 20px;'>
                  <img src="/user/img/geel.png" style='width:15px; height: 20px;'>
                  <img src="/user/img/wissel.png" style='width:25px; height: 15px;'>
                  <img src="/user/img/rood.jpg" style='width:15px; height: 20px;'>
                  @endif
                @endif
                @if(!($wedstrijden->opmerkingen[$i]->gele_kaarten == null))
                 <label>{{ $wedstrijden->opmerkingen[$i]->gele_kaarten }}</label>
                 <div hidden>{{ $check = 0 }} </div>
                @endif
                <br>
               @endif
              @endforeach
            @endfor
            @for($i = 0; $i < count($wedstrijden->opmerkingen); $i++)
              @foreach($wedstrijden->teams[0]->spelers as $speler)
                @if(!($wedstrijden->opmerkingen[$i]->rode_kaarten == null))
                  @if($speler->naam == $wedstrijden->opmerkingen[$i]->rode_kaarten)
                    <img src="/user/img/rood.jpg" style='width:15px; height: 20px;'>         
                    <label>{{$wedstrijden->opmerkingen[$i]->rode_kaarten}}</label>
                    <div hidden>{{ $check = 0 }} </div>
                  @endif
                @endif
              @endforeach
            @endfor
            @if($check !== 0)
              <strong>geen kaarten</strong>
            @endif
            <div style hidden>{{$check= 1}} </div>
          </div>
          <div class="well col-md-offset-2 col-md-4">
            <h3>{{ $wedstrijden->teams[1]->naam }}</h3>
            <hr>
            @for ($i = 0; $i < count($wedstrijden->opmerkingen); $i++)
              @foreach($wedstrijden->teams[1]->spelers as $speler)
               @if($speler->naam == $wedstrijden->opmerkingen[$i]->gele_kaarten) 
                @if(!($wedstrijden->opmerkingen[$i]->aantal_geel == null))
                 @if($wedstrijden->opmerkingen[$i]->aantal_geel == 1)
                 <img src="/user/img/geel.png" style='width:15px; height: 20px;'>
                 @elseif ($wedstrijden->opmerkingen[$i]->aantal_geel == 2)
                  <img src="/user/img/geel.png" style='width:15px; height: 20px;'>
                  <img src="/user/img/geel.png" style='width:15px; height: 20px;'>
                  <img src="/user/img/wissel.png" style='width:25px; height: 15px;'>
                  <img src="/user/img/rood.jpg" style='width:15px; height: 20px;'>
                  @endif
                @endif
                @if(!($wedstrijden->opmerkingen[$i]->gele_kaarten == null))
                 <label>{{ $wedstrijden->opmerkingen[$i]->gele_kaarten }}</label>
                 <div hidden>{{ $check = 0 }} </div>
                @endif
                <br>
               @endif
              @endforeach
            @endfor
            @for($i = 0; $i < count($wedstrijden->opmerkingen); $i++)
              @foreach($wedstrijden->teams[1]->spelers as $speler)
              @if(!($wedstrijden->opmerkingen[$i]->rode_kaarten == null))
                
                  @if($speler->naam == $wedstrijden->opmerkingen[$i]->rode_kaarten)
                    <img src="/user/img/rood.jpg" style='width:15px; height: 25px;'>         
                    <label>{{ $wedstrijden->opmerkingen[$i]->rode_kaarten }}</label>
                    <div hidden>{{ $check = 0 }} </div>
                  @endif
              @endif 
              @endforeach
            @endfor
            @if($check !== 0)
              <strong>geen kaarten</strong>
            @endif
            <div style hidden>{{$check= 1}} </div>
          </div>
        </div>
        <div class="row">
      <div class='col-md-offset-5 col-md-2 well' style='background:lightgreen; border-radius:45px; '>
        <h2 style='text-align: center;'>Wissels</h2>
      </div>
     </div>
        <div class="row">
          <div class='well col-md-offset-1 col-md-4' >
            <h3>{{ $wedstrijden->teams[0]->naam }}</h3>
            <hr>
            @for ($i = 0; $i < count($wedstrijden->opmerkingen); $i++)
            <div>
                @if($wedstrijden->opmerkingen[$i]->wissel !== null)
                  @foreach($wedstrijden->teams[0]->spelers as $speler)
                    @if($speler->naam == $wedstrijden->opmerkingen[$i]->wissel) 
                      <label style='color:red;'> {{ $wedstrijden->opmerkingen[$i]->wissel }} </label>  <img src="/user/img/wissel.png" style='width:25px; height: 15px;'> <label style='color:green;'> {{ $wedstrijden->opmerkingen[$i]->wissel_speler }} </label>
                      <div hidden>{{ $check = 0 }} </div>
                    @endif
                  @endforeach
                @endif
            </div>
            @endfor
            @if($check !== 0)
              <strong>geen wissels</strong>
            @endif
            <div style hidden>{{$check= 1}} </div>
          </div>
          <div class='well col-md-offset-2 col-md-4' >
            <h3>{{ $wedstrijden->teams[1]->naam }}</h3>
            <hr>
            @for ($i = 0; $i < count($wedstrijden->opmerkingen); $i++)
            <div>
                @if($wedstrijden->opmerkingen[$i]->wissel !== null)
                  @foreach($wedstrijden->teams[1]->spelers as $speler)
                    @if($speler->naam ==$wedstrijden->opmerkingen[$i]->wissel) 
                      <label style='color:red;'> {{ $wedstrijden->opmerkingen[$i]->wissel }} </label>  <img src="/user/img/wissel.png" style='width:25px; height: 15px;'> <label style='color:green;'> {{ $wedstrijden->opmerkingen[$i]->wissel_speler }} </label>
                      <div hidden>{{ $check = 0 }} </div>
                    @endif
                  @endforeach
                @endif
            </div>
            @endfor
            @if($check !== 0)
              <strong>geen wissels</strong>
            @endif
          </div>
        </div>
      <div class="row">
        <div class="well col-md-offset-1 col-md-10">
          <div id="disqus_thread"></div>
                         
        </div>
      </div>
      @else
      <div class='well' style='top:75px;'><label>Geen wedstrijddetails beschikbaar</label></div>
      @endif
    </div>
  </div>
</div>  
@endsection

 @section('footerSection')
 <script>
    var disqus_config = function () {
    this.page.url = 'https://voetbal.be/wedstrijden/{{$wedstrijden->id}}';  
    this.page.identifier = {{$wedstrijden->id}}; 
    };

    (function() { 
    var d = document, s = d.createElement('script');
    s.src = 'https://voetbaltracker.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
 </script> 

 @endsection