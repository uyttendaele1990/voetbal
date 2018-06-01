@extends('user/layouts/app')

@section('bg-img', asset('user/img/statistieken-bg.jpg'))

@section('title', 'Statistieken')

@section('subtitle', 'alles op 1 pagina, nog zo gemakkelijk')
@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<style>

#example1_wrapper > div:nth-child(1){
  display:none;
}
#example1_wrapper > div:nth-child(3){
  display:none;
}
table{
 margin-left:-50px;
}
/*div.well:nth-child(1) {
  background:gold;
}
div.well:nth-child(2) {
   background:silver;
}
div.well:nth-child(3) {
   background:#cd7f32;
}*/
body {
  background-image:url('{{asset("user/img/voet.jpg")}}');
  background-repeat: no-repeat;
  background-position-y: 500px;
  background-position-x: -65px;
  background-size: cover;
}
</style>
@endsection
@section('main-content')
<div class="content-wrapper">
	<div class = 'container'>
  	<div class="box box-primary">
      <div class="box-header with-border">
        @if((App\Model\admin\admin::where('seizoen', 1)->first()))
         <div class='well' style='text-align:center; margin-top:25px;background:orange;border-radius:24px'>
          <h1>Seizoen {{date('Y')-1}} - {{date('Y')}} is geëindigd</h1>
          <hr>
        </div>
        @endif 
    <!-- general form elements -->
        <div class='box' >
          <div class="box-body">
            <table id="example1" class="table table-bordered table-hover">
              <thead class="thead-light">
              <tr>
                <th>Nr</th>
                <th>naam</th>
                <th></th>
                <th>Logo</th>
                <th>aantal matchen</th>
                <th>goalen +</th>
                <th>goalen -</th>
                <th>Doelsdaldo</th>
                <th>Winst</th>
                <th>Gelijk</th>
                <th>Verlies</th>
                <th>Punten</th>
              </tr>
              </thead>
              <tbody>
              @foreach($teams as $team)
                <tr>
                  <td>{{ $loop->index+1 }}</td>
                  <td><a href="/teams/{{$team->id}}">{{ $team->naam }}</a></td>
                  <td><small> {{$team->slug}} </small></td>
                  <td><img src="/storage/{{ $team->logo }}" style='width:30px; height:30px; float:left;'></td>
                  <td><strong>{{ $team->aantal_wedstrijden}}</strong></td>
                  <td>{{ $team->goalen_voor }}</td>
                  <td>{{ $team->goalen_tegen }}</td>
                  <td>{{ $team->doelsaldo }}</td>
                  <td>{{ $team->wedstrijden_gewonnen }}</td>
                  <td>{{ $team->wedstrijden_gelijk }}</td>
                  <td>{{ $team->wedstrijden_verloren }}</td>
                  <td><strong>{{ $team->punten }}</strong></td>
                </tr>
              @endforeach
              </tbody>
            </table>
            <div class="row">
              <div class="alert-success col-md-offset-5 col-md-2" style='text-align:center; margin-top:30px;border-radius:25px;'>
                <label style='margin-bottom:10px; margin-top:10px'>Topscorers</label>
              </div>
            </div>
            <!-- <div class='row' style='text-align:center; padding-top:15px;'>
            @foreach($spelers as $speler)
                @if($speler->doelpunten_saldo !== 0)
                <div class="well col-md-3" style='border-radius:50%; margin-left:70px'>
                    <strong> {{ $loop->index+1 }}. </strong><br>              
                    <strong>{{$speler->naam}}</strong><br>
                    <img class="img-circle" src="/storage/{{ $speler->foto }}" alt="{{$speler->naam}}" width="60" height="60"><br>
                    <strong>{{ $speler->doelpunten_saldo }} doelpunten</strong><br>
                    <small>{{ $speler->teams->slug }}</small><br>
                </div>
                @endif
              @endforeach
            </div>   -->
            <div class="medala row" style='text-align:center'>
              <div class="coin gold col-md3" style='margin-left:90px'>
                <p>
                @if($spelers[0]->doelpunten_saldo !== 0)            
                  <img class="img-circle" src="/storage/{{ $spelers[0]->foto }}" alt="{{$spelers[0]->naam}}" width="60" height="60"><br>
                  <strong>{{$spelers[0]->naam}}</strong><br>
                  <strong>{{ $spelers[0]->doelpunten_saldo }} doelpunten</strong><br>
                  <small>{{ $spelers[0]->teams->slug }}</small><br>
                @endif
                </p>
              </div>
              <div class="coin silver " style='margin-left:90px'>
                <p>
                 @if($spelers[1]->doelpunten_saldo !== 0)             
                     <img class="img-circle" src="/storage/{{ $spelers[1]->foto }}" alt="{{$spelers[1]->naam}}" width="60" height="60"><br>
                     <strong>{{$spelers[1]->naam}}</strong><br>
                     <strong>{{ $spelers[1]->doelpunten_saldo }} doelpunten</strong><br>
                     <small>{{ $spelers[1]->teams->slug }}</small><br>
                @endif
                </p>
              </div>
              <div class="coin bronze " style='margin-left:90px'>
                <p>
                  @if($spelers[2]->doelpunten_saldo !== 0)              
                    <img class="img-circle" src="/storage/{{ $spelers[2]->foto }}" alt="{{$spelers[2]->naam}}" width="60" height="60"><br>
                    <strong>{{$spelers[2]->naam}}</strong><br>
                    <strong>{{ $spelers[2]->doelpunten_saldo }} doelpunten</strong><br>
                    <small>{{ $spelers[2]->teams->slug }}</small><br>
                @endif
                </p>
              </div>
            </div>
            <div class="row">
              <div class='col-md-3'></div>
              <div class='well col-md-6' style='text-align:center; margin-top:50px;opacity:0.8; border-radius:25px;background:lightgreen'>
              Aantal teams : <strong>{{ App\Model\admin\teams::all()->count() }}</strong><br>
              Wedstrijden gespeeld : <strong>{{ $wedstrijden->count() }}</strong> <br>
              Wedstrijden komend : <strong>{{ App\Model\admin\wedstrijden::all()->count() - $wedstrijden->count() }}</strong> <br>
              Aantal goalen gescoord : <strong>{{ $totaal }}</strong><br>
              Gemiddelde aantal goalen per wedstrijd : <strong>{{ round($totaal/$wedstrijden->count(), 2) }}</strong><br>
              gele kaarten : <strong>{{ App\Model\admin\opmerkingen::whereNotNull('gele_kaarten')->count()}}</strong><br>
              rode kaarten : <strong>{{ App\Model\admin\opmerkingen::whereNotNull('rode_kaarten')->count()}}</strong><br>
              </div>
              <div class='col-md-3'></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <a href="#" class="back-to-top"><i class="glyphicon glyphicon-chevron-up"></i></a>
</div>
@endsection

@section('footerSection')
<!-- alles inladen wat enkel op deze pagina gebruikt zal worden -->
<!-- DataTables -->
<script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<style>
.coin p{
  font-family: georgia;
  font-style: italic;
  position: absolute;
  font-size: 28px;
  z-index: 700;
  top: -19px;
  left: 19px;
  margin-top:40px;
  margin-left:10px;
  }

.coin.bronze p{  color: black;}
.coin.silver p{  color: black;}
.coin.gold p{  color: black;}

.coin{
  content: "";
  width: 250px; 
  height: 250px;
  display: inline-block;
  position: relative;
  margin: 5px;
  margin-top:25px;
  top: 6px;
  border-radius: 50%;
  z-index: 500;
  box-shadow:  2px 2px 2px 1px rgba(0, 0, 0, .1);
  }

.coin:after{
  content: "";
  width: 240px; 
  height: 240px;
  display: block;
  top: 4px;
  left: 4px;
  position: absolute;
  border-radius: 50%;
  z-index: 600;
  }

.coin:before{
  content: "";
  width: 250px; 
  height: 250px;
  display: block;
  position: absolute;
  border-radius: 50%;
  z-index: 500;
  }

.coin:hover{
  top: -1px;
  transition: all .5s ease-in-out;
  box-shadow:  0px 0px 5px 1px rgba(0, 0, 0, .2);
  }

.bronze{
  background: linear-gradient(45deg,  rgba(223,182,103,1) 0%,rgba(249,243,232,1) 56%,rgba(231,192,116,1) 96%); 
  }

.bronze:before{
  background: linear-gradient(135deg,  #d19c35 0%,#f7e6c5 50%,#e8b558 100%);
  border: 1px solid #e6b86a;
  }

.bronze:after{
  background: linear-gradient(45deg,  rgba(223,182,103,1) 0%,rgba(249,243,232,1) 56%,rgba(231,192,116,1) 96%);
  border-top: 1px solid rgba(255,255,255,0.3);
  border-left: 1px solid rgba(255,255,255,0.3);
  border-bottom: 1px solid rgba(209,156,53,0.3);
  border-right: 1px solid rgba(209,156,53,0.5);
  box-shadow: inset 0px 0px 2px 2px rgba(153, 106, 26, .05);
  }

.bronze:hover:after{
  background: linear-gradient(45deg,  rgba(223,182,103,1) 0%,rgba(249,243,232,1) 41%,rgba(231,192,116,1) 96%);
  border-top: 1px solid rgba(255,255,255,0.3);
  border-left: 1px solid rgba(255,255,255,0.3);
  border-bottom: 1px solid rgba(209,156,53,0.3);
  border-right: 1px solid rgba(209,156,53,0.5);
  box-shadow: inset 0px 0px 2px 2px rgba(153, 106, 26, .05);
  }

.silver{
  background: linear-gradient(45deg,  rgba(160,160,160,1) 0%,rgba(232,232,232,1) 56%);
  }

.silver:before{
  background: linear-gradient(45deg,  rgba(181,181,181,1) 0%,rgba(252,252,252,1) 56%,rgba(232,232,232,1) 96%);
  border: 1px solid rgba(181,181,181,1);
  }


.silver:after{
  background: linear-gradient(45deg,  rgba(181,181,181,1) 0%,rgba(252,252,252,1) 56%,rgba(232,232,232,1) 96%);
  border-top: 1px solid rgba(255,255,255,0.3);
  border-left: 1px solid rgba(255,255,255,0.3);
  border-bottom: 1px solid rgba(160,160,160,0.3);
  border-right: 1px solid rgba(160,160,160,0.5);
  box-shadow: inset 0px 0px 2px 2px rgba(150, 150, 150, .05);
  }

.silver:hover:after{
  background: linear-gradient(45deg,  rgba(181,181,181,1) 0%,rgba(252,252,252,1) 38%,rgba(232,232,232,1) 96%);
  border-top: 1px solid rgba(255,255,255,0.3);
  border-left: 1px solid rgba(255,255,255,0.3);
  border-bottom: 1px solid rgba(160,160,160,0.3);
  border-right: 1px solid rgba(160,160,160,0.5);
  box-shadow: inset 0px 0px 2px 2px rgba(150, 150, 150, .05);
  }

.gold{
background: linear-gradient(45deg,  rgba(242,215,12,1) 0%,rgba(255,255,255,1) 56%,rgba(252,235,0,1) 96%);
}

.gold:before{
  background: linear-gradient(45deg,  rgba(242,215,12,1) 0%,rgba(255,255,255,1) 56%,rgba(252,235,0,1) 96%);
  border: 1px solid rgba(242,215,12,1);
  }


.gold:after{
  background: linear-gradient(45deg,  rgba(242,215,12,1) 0%,rgba(255,255,255,1) 56%,rgba(252,235,0,1) 96%);
  border-top: 1px solid rgba(255,255,255,0.3);
  border-left: 1px solid rgba(255,255,255,0.3);
  border-bottom: 1px solid rgba(242,215,12,0.3);
  border-right: 1px solid rgba(242,215,12,0.3);
  box-shadow: inset 0px 0px 2px 2px rgba(150, 150, 150, .05);
  }

.gold:hover:after{
  background: linear-gradient(45deg,  rgba(242,215,12,1) 3%,rgba(255,255,255,1) 39%,rgba(252,235,0,1) 100%);
  border-top: 1px solid rgba(255,255,255,0.3);
  border-left: 1px solid rgba(255,255,255,0.3);
  border-bottom: 1px solid rgba(242,215,12,0.3);
  border-right: 1px solid rgba(242,215,12,0.3);
  box-shadow: inset 0px 0px 2px 2px rgba(150, 150, 150, .05);
  }
  </style>
@endsection