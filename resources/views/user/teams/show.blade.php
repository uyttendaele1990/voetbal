@extends('user/layouts/app')
@section('bg-img', Storage::disk('local')->url($teams->logo))
@section('title', $teams->naam  )
@section('bg-size', '500px')
@section('subtitle', $teams->slug)
@section('headsection')
@endsection
@section('main-content')
<div class="content-wrapper" >
  <!-- general form elements -->
  <div class='container' >
    <div class='row'>
      <div class='col-md-offset-4 col-md-4' style='margin-bottom:15px;'>
        <h3 style='text-align: center;'><a type="button" href="/teams/personal/{{$teams->id}}" class="btn btn-success">Wedstrijden van {{$teams->naam}}</a></h3>
      </div>
    </div>
    <div class='row'>
      <div class='col-md-offset-5 col-md-2 well'>
        <h3 style='text-align: center;'>Spelers</h3>
      </div>
    </div>
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Nr</th>
            <th>naam</th>
            <th>Foto</th>
            <th>Goalen</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($teams->spelers as $speler)
            <tr>
              <td>{{ $loop->index+1 }}</td>
              <td>{{ $speler->naam }}</td>
              <td><img src="/storage/{{ $speler->foto }}" style='width:40px; height:40px; float:left; border-radius:50%;'></td>
              <td>{{ $speler->doelpunten_saldo}} </td>
          @endforeach
          </tbody>
        </table>
      </div>
  </div>
      <!-- /.box-body -->
  <div class="box-footer" style='text-align: center;'>
    <a type="button" href="/teams" class="btn btn-danger">Terug</a>
  </div>
  <a href="" id="return-to-top"><i class="glyphicon glyphicon-chevron-up"></i></a>
</div>
@endsection