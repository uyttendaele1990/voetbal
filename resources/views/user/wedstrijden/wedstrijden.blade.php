@extends('user/layouts/app')

@section('headSection')
<style>
    .navbar-brand > img:nth-child(1){
  position:relative;
  top:-15px;
}
#mainNav{
  background-color: black;
  opacity:0.8;
  position:sticky;
}
.content-wrapper > div:nth-child(1) {
  position:relative;
  padding-top: 125px;
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
.lol2:hover .lol3 {
    display: inline-block;
}
.lol3 {
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
header {
  display:none;
}
body {
  background-image:url('{{asset("user/img/wed12.jpg")}}');
  background-repeat: no-repeat;
  background-size: cover;
   background-attachment: fixed;
   background-position-y: -350px;
}
.well {
    opacity:0.8;
    border-radius:25px;
}
h1 {
 background-color:grey;
 width:200px;
 height:50px;
 padding-top:10px;
 border-radius:10px;
 color:white;
 background-color:black;
 opacity:0.8;
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
     @if($wedstrijd->status == 1)
        <div class='row'>
            <div class="col-md-3"></div>        
            <div class="col-md-6 well">
                <div = class="lol1"> 
                    <h2>
                    <span class="lol" style='background: green;padding-top:19px;'>
                        {{ $wedstrijd->team1_score }} vs {{ $wedstrijd->team2_score }}
                    </span>
                    <a href="/wedstrijden/{{$wedstrijd->id}}" style='color: green;'>                
                    <div class='col-md-5' style="text-align:right;">
                        {{ $wedstrijd->teams[0]->naam }}
                    </div>
                    <div class='col-md-2' style="overflow: hidden;">
                        <center> vs </center>
                    </div>
                    <div class='col-md-5' style="text-align:left;">
                        {{ $wedstrijd->teams[1]->naam }}
                    </div>
                    </a>
                    </h2>
                </div>
            </div>
          <div class="col-md-offset-1 col-md-2 well" style='text-align: center'>
            <strong>{{ $wedstrijd->gespeeld_op }}</strong>
          </div>             
        </div>  
        <br>
      @endif         
    @endforeach
    @foreach ($wedstrijden as $wedstrijd)
     @if($wedstrijd->status == 0)
        <div class='row'>
            <div class="col-md-offset-3 col-md-6 well">
                <div = class="lol2"> 
                    <h2>
                    <span class="lol3" style='background: black;padding-top:8px;'>Word gespeeld op {{$wedstrijd->gespeeld_op}}</span>         
                    <div class='col-md-5' style="float: left; text-align:right;">{{ $wedstrijd->teams[0]->naam }}</div>
                    <div class='col-md-5' style="float: right; text-align:left;">{{ $wedstrijd->teams[1]->naam }}</div>
                    <div class='col-md-2' style="float: none;overflow: hidden;"><center> vs </center></div>
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