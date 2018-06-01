@extends('user/layouts/app')
@section('headSection')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
.navbar-brand > img:nth-child(1){
  position:relative;
  top:-15px;
}
#mainNav{
  position:fixed;
  background-color: black;
  opacity:0.8;
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
  margin-bottom:55px;
}
div.col-md-4 > a {
margin-bottom:15px;
 opacity:0.9;
}
div.col-md-4 div {
  right:15px;
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
    <div class="box box-primary" id='app'>
        @foreach ($teams as $team)
      <div class="col-md-4" >
       <div class='row'>
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
              Stop<span class="glyphicon glyphicon-envelope" style='margin-left:15px'></span>
            </a>                      
          @else
          <a class='btn btn-success' href="/email/{{ $team->id}}" style='border-radius:10px;'>
          Volg
          <span class="glyphicon glyphicon-envelope" style='margin-left:15px'></span>
         </a>         
          @endif
          <teams v-for='value in teams'
          v-if='value.id == {{$team->id}}'
        :id=value.id
        :key=value.index
        :likes=value.likes.length
        :email=value.email
        ></teams></div>
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
<script src='{{ asset("js/app.js")}}'></script>
<!-- ik heb de js cdn van bootstrap nog eens moeten herhalen deze word normaal gezen geladen in de header maar vue (app.js) breekte mijn dropdown van mijn navbar daarom dat ik dit erachter heb gezet -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
@endsection