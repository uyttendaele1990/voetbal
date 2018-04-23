@extends('user/layouts/app')

@section('bg-img', Storage::disk('local')->url($team->logo))
@section('bg-size', '500px')

@section('headSection')
<!-- css styling voor de tooltip -->
<style>
body {
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
  opacity:0.9;
}
.lol1:hover .lol {
    display: inline-block;
}
.lol {
    border-radius: 15px;
    text-align:center;
    width: 26%;
    height: 100%;
    opacity: 0.9;
    color: #fff;
    display:none;
    position: absolute;
    bottom: 50%;
    left: 50%;
    transform:translateX(-50%);
    margin-bottom: 15px;
}
.lol1:hover .lol2 {
    display: inline-block;
}
.lol2 {
    border-radius: 15px;
    text-align:center;
    width: 26%;
    height: 140%;
    opacity: 0.9;
    color: #fff;
    display:none;
    position: absolute;
    bottom: 50%;
    left: 50%;
    transform:translateX(-50%);
    margin-bottom: 15px;
}
.well {
    opacity:0.8;
    border-radius:25px;
}
body {
  background-image:url('{{asset("user/img/wed12.jpg")}}');
  background-repeat: no-repeat;
  background-size: cover;
   background-attachment: fixed;
   background-position-y: -350px;
}
</style>
@endsection
@section('main-content')
<div class="content-wrapper">
  <!-- general form elements -->
  <div class='container'>
    <center><h1>Wedstrijden</h1></center>
    <br>
    @foreach ($wedstrijden as $wedstrijd)
      @if(($wedstrijd->teams[0]->id == $team->id) OR ($wedstrijd->teams[1]->id == $team->id))
     <div class='row'>
        <div class="col-md-3"></div>
        <div class="col-md-6 well" >
           <div = class="lol1" style='color:black'> 
            <h2>
            @if($wedstrijd->status == 1)
                @if(($team->id == $wedstrijd->teams[0]->id) AND ($wedstrijd->team1_score > $wedstrijd->team2_score))
                    <span class="lol" style='background: green;padding-top:19px;'>
                        {{ $wedstrijd->team1_score }} vs {{ $wedstrijd->team2_score }}
                    </span>
                    <a href="/wedstrijden/{{$wedstrijd->id}}" style='color: green;'>
                @elseif(($team->id == $wedstrijd->teams[0]->id) AND ($wedstrijd->team1_score < $wedstrijd->team2_score))
                    <span class="lol" style='background: red;padding-top:19px;'>
                        {{ $wedstrijd->team1_score }} vs {{ $wedstrijd->team2_score }}
                    </span>
                    <a href="/wedstrijden/{{$wedstrijd->id}}" style='color: red;'>
                @elseif(($team->id == $wedstrijd->teams[1]->id) AND ($wedstrijd->team2_score > $wedstrijd->team1_score))
                    <span class="lol" style='background: green;padding-top:19px;'>
                        {{ $wedstrijd->team1_score }} vs {{ $wedstrijd->team2_score }}
                    </span>
                    <a href="/wedstrijden/{{$wedstrijd->id}}" style='color: green;'>
                @elseif(($team->id == $wedstrijd->teams[1]->id) AND ($wedstrijd->team1_score > $wedstrijd->team2_score))
                    <span class="lol" style='background: red;padding-top:19px;'>
                        {{ $wedstrijd->team1_score }} vs {{ $wedstrijd->team2_score }}
                    </span>
                    <a href="/wedstrijden/{{$wedstrijd->id}}" style='color: red;'>
                @elseif(($team->id == $wedstrijd->teams[1]->id) AND ($wedstrijd->team1_score == $wedstrijd->team2_score))
                    <span class="lol" style='background: orange;padding-top:19px;'>
                        {{ $wedstrijd->team1_score }} vs {{ $wedstrijd->team2_score }}
                    </span>
                    <a href="/wedstrijden/{{$wedstrijd->id}}" style='color: orange;'>
                @elseif(($team->id == $wedstrijd->teams[0]->id) AND ($wedstrijd->team1_score == $wedstrijd->team2_score))
                    <span class="lol" style='background: orange;padding-top:19px;'>
                        {{ $wedstrijd->team1_score }} vs {{ $wedstrijd->team2_score }}
                    </span>
                    <a href="/wedstrijden/{{$wedstrijd->id}}" style='color: orange;'>
                @endif
            @else
                <span class="lol2" style='background: black;padding-top:8px;'>
                    Word gespeeld op {{$wedstrijd->gespeeld_op}}
                </span>
            @endif                 
                <div class='col-md-5' style="float: left; text-align:right;">
                    {{ $wedstrijd->teams[0]->naam }}
                </div>
                <div class='col-md-5' style="float: right; text-align:left;">
                    {{ $wedstrijd->teams[1]->naam }}
                </div>
                <div class='col-md-2' style="float: none;overflow: hidden;">
                    <center> vs </center>
                </div>
            @if($wedstrijd->status == 1)</a>@endif
          </a>
        </h2>
           </div>
        </div>           
      </div>  
      <br>
      @endif         
    @endforeach
  </div>
  <a href="#" class="back-to-top"><i class="glyphicon glyphicon-chevron-up"></i></a>
</div>  
@endsection