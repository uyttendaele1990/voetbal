@extends('user/layouts/app')

@section('bg-img', asset('user/img/wedstrijden-bg.jpg'))
@section('title', $wedstrijden->team1_score.' - '.$wedstrijden->team2_score)

@section('subtitle', $spelers1[0]->teams->naam.' vs '.$spelers2[0]->teams->naam)
@section('main-content')
<!-- {{$wedstrijden}} -->
<div class="content-wrapper" style='text-align: center;'>
  <!-- general form elements -->
  <div class='container'>
     <h3>Opmerkingen bij de wedstrijd</h3>
     <br>
     <br>
     <div class="box-body">
     @if(App\Model\admin\opmerkingen::where('wedstrijden_id', $wedstrijden->id)->first())
      <div class="row">
        <div class='col-md-6'>
           <img src="/storage/{{ $team1->logo }}" style='width:100px; height:100px; margin-bottom: 15px;'>
        </div>
        <div class='col-md-6'>
           <img src="/storage/{{ $team2->logo }}" style='width:100px; height:100px; margin-bottom: 15px;'>
        </div>
      </div>
      <h2>Goalen</h2>
      <br>
        <div class="row">
          <div class='well col-md-offset-1 col-md-4' style='text-align: center;''>
            <h3>{{$spelers1[0]->teams->naam}}</h3>
            <hr>
            @for ($i = 0; $i < count($goal); $i++)
                @if(!($goal[$i] == null))
                @foreach($spelers1 as $speler)
                  @if($speler->naam == $goal[$i]) 
                  <h3>{{$gnr[$i]}} * {{$goal[$i]}}</h3>
                  <img src="/storage/{{ $speler->foto }}" style='width:45px; height:45px; float:left;border-radius:50%;margin-bottom: 15px;margin-left: 150px;'>
                  <br>
                  @endif
                @endforeach
                @endif
                <br>
            @endfor
          </div>
          <div class='well col-md-offset-2 col-md-4' style='text-align: center;'>
            <h3>{{$spelers2[0]->teams->naam}}</h3>
            <hr>
            @for ($i = 0; $i < count($goal); $i++)
                @if(!($goal[$i] == null))
                @foreach($spelers2 as $speler)
                  @if($speler->naam == $goal[$i]) 
                  <h3>{{$gnr[$i]}} * {{$goal[$i]}}</h3>
                  <img src="/storage/{{ $speler->foto }}" style='width:45px; height:45px; float:left;border-radius:50%;margin-bottom: 15px;margin-left: 150px;'>
                  <br>
                  @endif
                @endforeach
                @endif
                <br>
            @endfor
          </div>
        </div>
        <br>
        <h2>Kaarten</h2>
        <br>
        <div class='row'>
          <div class="well col-md-offset-1 col-md-4"> 
            <h3>{{$spelers1[0]->teams->naam}}</h3>
            <hr>
            @for ($i = 0; $i < count($geel); $i++)
              @foreach($spelers1 as $speler)
               @if($speler->naam == $geel[$i]) 
                @if(!($g1[$i] == null))
                 @if($g1[$i] == 1)
                 <img src="/user/img/geel.png" style='width:15px; height: 20px;'>
                 @elseif ($g1[$i] == 2)
                  <img src="/user/img/geel.png" style='width:15px; height: 20px;'>
                  <img src="/user/img/geel.png" style='width:15px; height: 20px;'>
                  <img src="/user/img/wissel.png" style='width:25px; height: 15px;'>
                  <img src="/user/img/rood.jpg" style='width:15px; height: 20px;'>
                  @endif
                @endif
                @if(!($geel[$i] == null))
                 <label>{{$geel[$i]}}</label>
                @endif
                <!-- <small>{{$wedstrijden->team1_id}}</small> -->
                <br>
               @endif
              @endforeach
            @endfor
            <br>
            @for($i = 0; $i < count($rood); $i++)
              @if(!($rood[$i] == null))
                @foreach($spelers1 as $speler)
                  @if($speler->naam == $rood[$i])
                    <img src="/user/img/rood.jpg" style='width:15px; height: 20px;'>         
                    <label>{{$rood[$i]}}</label>
                    <!-- <small>{{$wedstrijden->team1_id}}</small> -->
                  @endif
                @endforeach
              @endif
            @endfor
          </div>
          <div class="well col-md-offset-2 col-md-4">
            <h3>{{$spelers2[0]->teams->naam}}</h3>
            <hr>
            @for ($i = 0; $i < count($geel); $i++)
              @foreach($spelers2 as $speler)
               @if($speler->naam == $geel[$i]) 
                @if(!($g1[$i] == null))
                 @if($g1[$i] == 1)
                 <img src="/user/img/geel.png" style='width:15px; height: 20px;'>
                 @elseif ($g1[$i] == 2)
                  <img src="/user/img/geel.png" style='width:15px; height: 20px;'>
                  <img src="/user/img/geel.png" style='width:15px; height: 20px;'>
                  <img src="/user/img/wissel.png" style='width:25px; height: 15px;'>
                  <img src="/user/img/rood.jpg" style='width:15px; height: 20px;'>
                  @endif
                @endif
                @if(!($geel[$i] == null))
                 <label>{{$geel[$i]}}</label>
                @endif
                <!-- <small>{{$wedstrijden->team2_id}}</small> -->
                <br>
               @endif
              @endforeach
            @endfor
            <br>
            @for($i = 0; $i < count($rood); $i++)
              @if(!($rood[$i] == null))
                @foreach($spelers2 as $speler)
                  @if($speler->naam == $rood[$i])
                    <img src="/user/img/rood.jpg" style='width:15px; height: 25px;'>         
                    <label>{{$rood[$i]}}</label>
                    <!-- <small>{{$wedstrijden->team2_id}}</small> -->
                  @endif
                @endforeach
              @endif
            @endfor
          </div>
        </div>
        <br>
        <h2>Wissels</h2>
        <br>
        <div class='well col-md-offset-1 col-md-4' >
          <h3>{{$spelers1[0]->teams->naam}}</h3>
          <hr>
          @for ($i = 0; $i < count($wissel); $i++)
          <div>
              @if(($wissel[$i] == null))
              @else
                @foreach($spelers1 as $speler)
                  @if($speler->naam == $wissel[$i]) 
                    <label style='color:red;'> {{$wissel[$i]}} </label>  <img src="/user/img/wissel.png" style='width:25px; height: 15px;'> <label style='color:green;'> {{$wissel_speler[$i]}} </label>
                  @endif
                @endforeach
              @endif
          </div>
          @endfor
        </div>
        <div class='well col-md-offset-2 col-md-4' >
          <h3>{{$spelers2[0]->teams->naam}}</h3>
          <hr>
          @for ($i = 0; $i < count($wissel); $i++)
          <div>
              @if(($wissel[$i] == null))
              @else
                @foreach($spelers2 as $speler)
                  @if($speler->naam == $wissel[$i]) 
                    <label style='color:red;'> {{$wissel[$i]}} </label>  <img src="/user/img/wissel.png" style='width:25px; height: 15px;'> <label style='color:green;'> {{$wissel_speler[$i]}} </label>
                  @endif
                @endforeach
              @endif
          </div>
          @endfor
        </div>
      @else
      <div>Een wedstrijd waar niet zoveel over te vertellen valt, geen details beschikbaar</div>
      @endif
     </div>
  </div>
</div>  
@endsection