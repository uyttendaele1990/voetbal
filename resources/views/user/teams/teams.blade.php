@extends('user/layouts/app')
@section('headSection')
<!-- ik kreeg mijn emails niet in orde, lang op zitten sukkelen met for loops en foreachs geprobeerd maar ik kreeg het niet zoals ik het wou, uiteindelijk maar besloten om het overtollige gewoon onzichtbaar te maken... -->
<style>
.navbar-brand > img:nth-child(1){
  position:relative;
  top:-15px;
}
#mainNav{
  position:fixed;
  background-color: black;
  opacity:0.6;
}
.box-body > div:nth-child(1){
  position:relative;
  
}
header {
  display:none;
}
body {
  background-image:url('{{asset("user/img/wed12.jpg")}}');
  background-repeat: no-repeat;
  background-size: cover;
}
div.col-md-12 {
  margin: 0 auto;
  cursor:pointer;
  border-radius:15px;
  height:250px;
  width: 250px;
  background-size: cover;
  margin-bottom:75px;
  margin-left:45px;
  background-repeat: no-repeat;
}
div.col-md-4:nth-child(1){
  padding-top: 125px;
}
div.col-md-4:nth-child(2){
  padding-top: 125px;
}
div.col-md-4:nth-child(3){
  padding-top: 125px;
}
div.col-md-4 {
  text-align:center;
}
div.col-md-4 > a {
margin-bottom:15px;
 opacity:0.9;
}
</style>
<script>
function checkTeam(id){
  window.location.href = "https://voetbal.be/teams/"+id;
}
</script>
@endsection
@section('bg-img', asset('user/img/teams-bg.jpg'))

@section('title', 'Teams')

@section('main-content')
<div class="content-wrapper">
  <!-- general form elements -->
  <div class='container'>
    <div class="box box-primary">
      @foreach ($teams as $team)
      <div class="col-md-4" >
        @if(Auth::user()->emails->where('team_id', $team->id)->first())                      
           <form id='delete-form-{{$team->id}}' action="{{ route('email.destroy', $team->id) }}" method='post' style='display:none;'>
            {{ csrf_field() }}
            {{ method_field('DELETE')}}
           </form>
            <a class='btn btn-danger' style='border-radius:10px' href="{{ route('wedstrijden.index')}}" onclick="
                if(confirm('Ben je zeker dat je deze ploeg niet meer wilt volgen?'))
                {
                  event.preventDefault();
                  // het id meegeven
                  document.getElementById('delete-form-{{$team->id }}').submit();
                }
                else{
                  event.preventDefault();
                }">
              Schrijf uit<span class="glyphicon glyphicon-envelope" style='margin-left:15px'></span>
            </a>                      
          @else
         <a  class='btn btn-success' href="/email/{{ $team->id}}" style='border-radius:10px;'>Volg<span class="glyphicon glyphicon-envelope" style='margin-left:15px'></span></a>
          @endif
      <div onclick='checkTeam({{$team->id}})' class="col-md-12" alt='{{$team->naam}}' style='background-image:url("/storage/{{ $team->logo }}");'>
        </div>
      </div>
      @endforeach
    </div>
</div>
<a href="#" class="back-to-top"><i class="glyphicon glyphicon-chevron-up"></i></a>
</div>
@endsection

@section('footerSection')
@endsection


<!--  @if(Auth::user()->emails->where('team_id', $team->id)->first())                      
           <form id='delete-form-{{$team->id}}' action="{{ route('email.destroy', $team->id) }}" method='post' style='display:none;'>
            {{ csrf_field() }}
            {{ method_field('DELETE')}}
           </form><center>
            <a class='btn btn-danger' style='position: absolute;bottom: 0;border-radius:10px' href="{{ route('wedstrijden.index')}}" onclick="
                if(confirm('Ben je zeker dat je deze ploeg niet meer wilt volgen?'))
                {
                  event.preventDefault();
                  // het id meegeven
                  document.getElementById('delete-form-{{$team->id }}').submit();
                }
                else{
                  event.preventDefault();
                }">
              <span class="glyphicon glyphicon-envelope" style='color:red;'></span>
            </a>                      
          @else
         <a  class='btn btn-success' href="/email/{{ $team->id}}" style='position: absolute;bottom: 0;border-radius:10px'><span class="glyphicon glyphicon-envelope" ></span></a></center>
          @endif -->