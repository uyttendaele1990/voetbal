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
      </div>
    </div>
  </div>
</div>
  </div>
</div>
@endsection