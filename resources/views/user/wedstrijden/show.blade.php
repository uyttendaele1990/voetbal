@extends('user/layouts/app')

@section('bg-img', asset('user/img/wedstrijden-bg.jpg'))
@section('title', $wedstrijden->team1_score.' - '.$wedstrijden->team2_score)

@section('subtitle', $wedstrijden->teams[0]->naam.' vs '.$wedstrijden->teams[1]->naam)
@section('main-content')
<!-- {{$wedstrijden}} -->
<a href="#" class='back-to-top'><i class="glyphicon glyphicon-chevron-up"></i></a>
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
           <img src="/storage/{{ $wedstrijden->teams[0]->logo }}" style='width:100px; height:100px; margin-bottom: 15px;'>
        </div>
        <div class='col-md-6'>
           <img src="/storage/{{ $wedstrijden->teams[1]->logo }}" style='width:100px; height:100px; margin-bottom: 15px;'>
        </div>
      </div>
      <h2>Goalen</h2>
      <br>
        <div class="row">
          <div class='well col-md-offset-1 col-md-4' style='text-align: center;''>
            <h3>{{ $wedstrijden->teams[0]->naam }}</h3>
            <hr>
            @for ($i = 0; $i < count($wedstrijden->opmerkingen); $i++)
                @if(!($wedstrijden->opmerkingen[$i]->gescoord_door == null))
                @foreach($wedstrijden->teams[0]->spelers as $speler)
                  @if($speler->naam == $wedstrijden->opmerkingen[$i]->gescoord_door) 
                  <h3>{{ $wedstrijden->opmerkingen[$i]->aantal_gescoord }} * {{ $wedstrijden->opmerkingen[$i]->gescoord_door }}</h3>
                  <img src="/storage/{{ $speler->foto }}" style='width:45px; height:45px; float:left;border-radius:50%;margin-bottom: 15px;margin-left: 150px;'>
                  <br>
                  @endif
                @endforeach
                @endif
                <br>
            @endfor
          </div>
          <div class='well col-md-offset-2 col-md-4' style='text-align: center;''>
            <h3>{{ $wedstrijden->teams[1]->naam }}</h3>
            <hr>
            @for ($i = 0; $i < count($wedstrijden->opmerkingen); $i++)
              @if(!($wedstrijden->opmerkingen[$i]->gescoord_door == null))
                @foreach($wedstrijden->teams[1]->spelers as $speler)
                  @if($speler->naam == $wedstrijden->opmerkingen[$i]->gescoord_door)
                    <h3>{{ $wedstrijden->opmerkingen[$i]->aantal_gescoord }} * {{ $wedstrijden->opmerkingen[$i]->gescoord_door }}</h3>
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
                @endif
                <!-- <small>{{$wedstrijden->team1_id}}</small> -->
                <br>
               @endif
              @endforeach
            @endfor
            <br>
            @for($i = 0; $i < count($wedstrijden->opmerkingen); $i++)
              @if(!($wedstrijden->opmerkingen[$i]->rode_kaarten == null))
                @foreach($wedstrijden->teams[0]->spelers as $speler)
                  @if($speler->naam == $wedstrijden->opmerkingen[$i]->rode_kaarten)
                    <img src="/user/img/rood.jpg" style='width:15px; height: 20px;'>         
                    <label>{{$$wedstrijden->opmerkingen[$i]->rode_kaarten}}</label>
                    <!-- <small>{{$wedstrijden->team1_id}}</small> -->
                  @endif
                @endforeach
              @endif
            @endfor
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
                @endif
                <br>
               @endif
              @endforeach
            @endfor
            <br>
            @for($i = 0; $i < count($wedstrijden->opmerkingen); $i++)
              @if(!($wedstrijden->opmerkingen[$i]->rode_kaarten == null))
                @foreach($wedstrijden->teams[1]->spelers as $speler)
                  @if($speler->naam == $wedstrijden->opmerkingen[$i]->rode_kaarten)
                    <img src="/user/img/rood.jpg" style='width:15px; height: 25px;'>         
                    <label>{{ $wedstrijden->opmerkingen[$i]->rode_kaarten }}</label>
                  @endif
                @endforeach
              @endif
            @endfor
          </div>
        </div>
        <br>
        <h2>Wissels</h2>
        <br>
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
                  @endif
                @endforeach
              @endif
          </div>
          @endfor
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
                  @endif
                @endforeach
              @endif
          </div>
          @endfor
        </div>
      </div>
      <div class="row">
        <div class="well col-md-offset-1 col-md-10">
          <div id="disqus_thread"></div>
          <script>
          /**
          *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
          *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
          var disqus_config = function () {
          this.page.url = 'https://voetbal.be/wedstrijden/{{$wedstrijden->id}}';  // Replace PAGE_URL with your page's canonical URL variable
          this.page.identifier = {{$wedstrijden->id}}; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
          };

          (function() { // DON'T EDIT BELOW THIS LINE
          var d = document, s = d.createElement('script');
          s.src = 'https://voetbaltracker.disqus.com/embed.js';
          s.setAttribute('data-timestamp', +new Date());
          (d.head || d.body).appendChild(s);
          })();
          </script>                 
        </div>
      </div>
      @else
      <div>Een wedstrijd waar niet zoveel over te vertellen valt, geen details beschikbaar</div>
      @endif
     </div>
  </div>
</div>  
@endsection