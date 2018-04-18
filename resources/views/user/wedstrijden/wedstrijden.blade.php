@extends('user/layouts/app')

@section('bg-img', asset('user/img/wedstrijden-bg.jpg'))

@section('title', 'Wedstrijden')

@section('subtitle', 'Alle wedstrijden van het seizoen')
@section('headSection')
<!-- css styling voor de tooltip -->
<style>
    .lol1:hover .lol {
        display: inline-block;
    }
    .lol {
        border-radius: 15px;
        text-align:center;
        width: 26%;
        height: 220%;
        opacity: 0.9;
        color: #fff;
        display:none;
        position: absolute;
        bottom: 50%;
        left: 50%;
        transform:translateX(-50%);
        margin-bottom: 15px;
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
            <div class="col-md-offset-3 col-md-6" >
                <div = class="lol1"> 
                    <span class="lol" style='background: green;padding-top:14px;'>
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
                </div>
            </div>           
        </div>  
        <br>
      @endif         
    @endforeach
    @foreach ($wedstrijden as $wedstrijd)
     @if($wedstrijd->status == 0)
        <div class='row'>
            <div class="col-md-offset-3 col-md-6" >
                <div = class="lol1"> 
                    <span class="lol" style='background: black;padding-top:3px;'>Wedstrijd nog niet gespeeld</span>         
                    <div class='col-md-5' style="float: left; text-align:right;">{{ $wedstrijd->teams[0]->naam }}</div>
                    <div class='col-md-5' style="float: right; text-align:left;">{{ $wedstrijd->teams[1]->naam }}</div>
                    <div class='col-md-2' style="float: none;overflow: hidden;"><center> vs </center></div>
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