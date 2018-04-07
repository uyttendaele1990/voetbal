@extends('user/layouts/app')

@section('bg-img', Storage::disk('local')->url($team->logo))
@section('bg-size', '500px')
@section('title', $team->naam)

@section('subtitle', 'Wedstrijden')
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
      @if(($wedstrijd->team1_id == $team->id) OR ($wedstrijd->team2_id == $team->id))
     <div class='row'>
        <div class="col-md-offset-3 col-md-6" >
           <div = class="lol1" style='color:black'> 
            @if($wedstrijd->status == 1)
                @if( ($team->id == $wedstrijd->team1_id) AND ($wedstrijd->team1_score > $wedstrijd->team2_score) )
                    <span class="lol" style='background: green;padding-top:14px;'>{{ $wedstrijd->team1_score }} vs {{ $wedstrijd->team2_score }}</span><a href="/wedstrijden/{{$wedstrijd->id}}" style='color: green;'>
                @elseif( ($team->id == $wedstrijd->team1_id) AND ($wedstrijd->team1_score < $wedstrijd->team2_score) )
                    <span class="lol" style='background: red;padding-top:14px;'>{{ $wedstrijd->team1_score }} vs {{ $wedstrijd->team2_score }}</span><a href="/wedstrijden/{{$wedstrijd->id}}" style='color: red;'>
                @elseif( ($team->id == $wedstrijd->team2_id) AND ($wedstrijd->team2_score > $wedstrijd->team1_score) )
                    <span class="lol" style='background: green;padding-top:14px;'>{{ $wedstrijd->team1_score }} vs {{ $wedstrijd->team2_score }}</span><a href="/wedstrijden/{{$wedstrijd->id}}" style='color: green;'>
                @elseif( ($team->id == $wedstrijd->team2_id) AND ($wedstrijd->team1_score > $wedstrijd->team2_score) )
                    <span class="lol" style='background: red;padding-top:14px;'>{{ $wedstrijd->team1_score }} vs {{ $wedstrijd->team2_score }}</span><a href="/wedstrijden/{{$wedstrijd->id}}" style='color: red;'>
                @elseif( ($team->id == $wedstrijd->team2_id) AND ($wedstrijd->team1_score == $wedstrijd->team2_score) )
                    <span class="lol" style='background: orange;padding-top:14px;'>{{ $wedstrijd->team1_score }} vs {{ $wedstrijd->team2_score }}</span><a href="/wedstrijden/{{$wedstrijd->id}}" style='color: orange;'>
                @elseif( ($team->id == $wedstrijd->team1_id) AND ($wedstrijd->team1_score == $wedstrijd->team2_score) )
                    <span class="lol" style='background: orange;padding-top:14px;'>{{ $wedstrijd->team1_score }} vs {{ $wedstrijd->team2_score }}</span><a href="/wedstrijden/{{$wedstrijd->id}}" style='color: orange;'>
                @endif
            @else
                <span class="lol" style='background: black;padding-top:3px;'>Wedstrijd nog niet gespeeld</span>
            @endif                 
            
                <div class='col-md-5' style="float: left; text-align:right;">{{ $teams->where('id', $wedstrijd->team1_id)->first()->naam }}</div>
                <div class='col-md-5' style="float: right; text-align:left;">{{ $teams->where('id', $wedstrijd->team2_id)->first()->naam }}</div>
                <div class='col-md-2' style="float: none;overflow: hidden;"><center> vs </center></div>
            @if($wedstrijd->status == 1)</a>@endif
           </div>
        </div>           
      </div>  
      <br>
      @endif         
    @endforeach
  </div>
</div>  
@endsection