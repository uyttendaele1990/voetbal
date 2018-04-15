@extends('user/layouts/app')

@section('bg-img', asset('user/img/statistieken-bg.jpg'))

@section('title', 'Statistieken')

@section('subtitle', 'alles op 1 pagina, nog zo gemakkelijk')

@section('main-content')
<div class="content-wrapper">
	<div class = 'container'>
  	<div class="box box-primary">
      <div class="box-header with-border">
         <div>
           <h2 class="box-title" style='margin: 5px';>Statistieken</h2>
        </div>
    <!-- general form elements -->
        <div class='box' >
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
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
                  <td>{{ $team->naam }}</td>
                  <td><small> {{$team->slug}} </small></td>
                  <td><img src="/storage/{{ $team->logo }}" style='width:30px; height:30px; float:left;'></td>
                  <td>{{ $team->aantal_wedstrijden}}</td>
                  <td>{{ $team->goalen_voor }}</td>
                  <td>{{ $team->goalen_tegen }}</td>
                  <td>{{ $totaal= $team->goalen_voor - $team->goalen_tegen }} </td>
                  <td>{{ $team->wedstrijden_gewonnen }}</td>
                  <td>{{ $team->wedstrijden_gelijk }}</td>
                  <td>{{ $team->wedstrijden_verloren }}</td>
                  <td>{{ $team->punten }}</td>
                </tr>
              @endforeach
              </tbody>
            </table>
            <div class="well col-md-offset-3 col-md-6" style='text-align:center; margin-top:30px;'>
              <label style='margin-bottom:10px'>Topscorers van de competitie</label>
              <div class='row'>
                <div class="col-md-offset-2 col-md-1"> 
                  @foreach($spelers as $speler)
                    <small class='pull-right' style='margin-right: 10px;'> {{ $loop->index+1 }}. </small><br>
                  @endforeach
                </div>
                <div class="col-md-3">
                  @foreach($spelers as $speler)
                    <strong>{{$speler->naam}}</strong><br>
                  @endforeach
                </div>
                <div class="col-md-2">
                  @foreach($spelers as $speler)
                    <strong class="pull-left" style='margin-left: 15px;'>{{ $speler->doelpunten_saldo }}</strong><br>
                  @endforeach
                </div>
                <div class="col-md-3">
                  @foreach($spelers as $speler)
                    <small class="pull-left" style='margin-left: 15px;'>{{ $speler->teams->slug }}</small><br>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <a href="#" class="back-to-top"><i class="glyphicon glyphicon-chevron-up"></i></a>
</div>
@endsection