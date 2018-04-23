@extends('user/layouts/app')
@section('bg-img', Storage::disk('local')->url($teams->logo))
@section('bg-size', '500px')
@section('headSection')
<style>
header {
  opacity:0.9;
}
.site-heading > h1{
  position:relative;
  padding-top:350px;
}

.navbar-brand > img:nth-child(1){
  position:relative;
  top:-15px;
}
#mainNav{
    position:fixed;
  background-color: black;
  opacity:0.6;
}
div.col-md-3 {
    border-radius:25px;
    margin:45px;
}
body {
  background-image:url('{{asset("user/img/wed12.jpg")}}');
  background-repeat: no-repeat;
  background-size: cover;
   background-attachment: fixed;
   background-position-y: -350px;
}
.details {
  text-align:center;
  border-radius:15px;
}
.imagesl {
  margin-left:1px;
}
label {
  font-size:30px;
}
</style>
@endsection
@section('main-content')
<div class="content-wrapper" >
  <!-- general form elements -->
  <div class='container' >
    <div class='row'>
      <div class="col-md-offset-4"></div>
      <div class="col-md-4" style='text-align:center; margin-bottom:15px;'>
       @if(Auth::user()->emails->where('team_id', $teams->id)->first())
         <form id='delete-form-{{$teams->id}}' action="{{ route('email.destroy', $teams->id) }}" method='post' style='display:none;'>
          {{ csrf_field() }}
          {{ method_field('DELETE')}}
         </form>
          <a class='btn btn-warning' href="{{ route('wedstrijden.index')}}" onclick="
              if(confirm('Ben je zeker dat je deze ploeg niet meer wilt volgen?'))
              {
                event.preventDefault();
                // het id meegeven
                document.getElementById('delete-form-{{$teams->id }}').submit();
              }
              else{
                event.preventDefault();
              }"  style='border-radius:15px'>
            Ontvolg {{$teams->naam}}
      @else
          <a class='btn btn-success' href="/email/{{ $teams->id}}"  style='border-radius:15px'>Volg {{$teams->naam}}
      @endif
      <span style='margin-left:15px' class="glyphicon glyphicon-envelope"></span>
      </a>
      </div>
      <div class='col-md-offset-4 col-md-4' style='margin-bottom:15px;'>
        <h3 style='text-align: center;'><a type="button" href="/teams/personal/{{$teams->id}}" class="btn btn-success" style='border-radius:15px'>Wedstrijden van {{$teams->naam}}</a></h3>
      </div>
    </div>
    <div class='row'>
      <div class='col-md-offset-5 col-md-2 well' style='background:lightblue; border-radius:15px; '>
        <h3 style='text-align: center;'>Spelers</h3>
      </div>
    </div>
      <!-- <div class="box-body">
        <table id="example1" class="table table-bordered table-hover">
          <thead class="thead-light">
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
              <td>{{ $loop->index+1 }}
              <td>{{ $speler->naam }}
              <td><img src="/storage/{{ $speler->foto }}" style='width:40px; height:40px; float:left; border-radius:50%;'>
              <td>{{ $speler->doelpunten_saldo}} 
          @endforeach
          </tbody>
        </table>
      </div> -->
      @foreach ($teams->spelers as $speler)
      <div class='col-md-3'>
              <div class='imagesl row'>
              <img src="/storage/{{ $speler->foto }}" style='width:250px; height:250px;border-radius:50%;'>
              </div>
              <br>
              <div class='well details'>
               Naam : <br>
               <label>{{ $speler->naam }}</label><br>
               Goalen : <label>{{ $speler->doelpunten_saldo}}</label>
            </div>
            </div>
          @endforeach
  </div>
      <!-- /.box-body -->
  <div class="box-footer" style='text-align: center;'>
    <a type="button" href="/teams" class="btn btn-danger" style='border-radius:15px'>Terug</a>
  </div>
  <a href="#" class="back-to-top"><i class="glyphicon glyphicon-chevron-up"></i></a>
</div>
@endsection