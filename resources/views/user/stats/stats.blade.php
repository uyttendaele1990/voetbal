@extends('user/layouts/app')

@section('bg-img', asset('user/img/statistieken-bg.jpg'))

@section('title', 'Statistieken')

@section('subtitle', 'alles op 1 pagina, nog zo gemakkelijk')
@section('headSection')

<style>
div.well:nth-child(1) {
  background:gold;
}
div.well:nth-child(2) {
   background:silver;
}
div.well:nth-child(3) {
   background:#cd7f32;
}
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
            <div class="row">
              <div class="alert-success col-md-offset-5 col-md-2" style='text-align:center; margin-top:30px;border-radius:25px;'>
                <label style='margin-bottom:10px; margin-top:10px'>Topscorers</label>
              </div>
            </div>
            <div class='row' style='text-align:center; padding-top:15px;'>
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
          </div>  
          </div>
        </div>
      </div>
    </div>
  </div>
  <a href="#" class="back-to-top"><i class="glyphicon glyphicon-chevron-up"></i></a>
</div>
@endsection