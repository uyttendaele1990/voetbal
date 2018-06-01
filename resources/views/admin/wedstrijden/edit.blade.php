@extends('admin/layouts/app')
@section('headSection')

<script>
  //uren gekloot aan dit scriptje, pun van het verhaal: and kan js niet lezen, het moet als && staan ...
  //indien de score velden null zijn (leeg) zetten we 0 als value
  //indien niet leeg pakken we de value van de db
  if( ( {!! json_encode($wedstrijd->team1_score) !!} === null ) && ( {!! json_encode($wedstrijd->team2_score) !!} === null ) ){
  var score1 = 0;
  var score2 = 0;  
  }  else  {
  var score1 = {!! json_encode($wedstrijd->team1_score) !!};
  var score2 = {!! json_encode($wedstrijd->team2_score) !!};
  }
  // indien de checkbox checked is(=status is 1) dan displayen we het inputveld en plaatsen we er een value in
  //zodat empty values doorgeven aan de db terwijl status gelijk is aan 1(= wedstrijd gespeeld) niet mogelijk is
  function showHide(){
  if(document.getElementById('show').checked){
    document.getElementById('team1_score').style.display='block';
    document.getElementById('team2_score').style.display='block';
    document.getElementById('team1_score').value= score1;
    document.getElementById('team2_score').value= score2;
  }  else  {
    // als de checkbox niet aangeklikt is of afgeklikt word dan displayen we niets en zetten we de values naar null
    document.getElementById('team1_score').style.display='none';
    document.getElementById('team2_score').style.display='none';
    document.getElementById('team1_score').value= null;
    document.getElementById('team2_score').value= null;
  }
}
</script>
@endsection
@section('main-content')
@if((App\Model\admin\admin::where('seizoen', 0)->first()))
<div class="content-wrapper">
  <!-- general form elements -->
  <div class="box box-primary">
    <div class="box-header with-border" style='text-align:center'>
      <ol class="breadcrumb">
        <li><a href="{{route('wedstrijden.index')}}">Wedstrijden</a></li>
        <li><a href="{{route('wedstrijden.edit', $wedstrijd->id)}}">Edit</a></li>
      </ol>
    </div>
    @include('includes.messages')
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="{{ route('wedstrijden.update', $wedstrijd->id) }}" method='post'>
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <div class="box-body">
        <div class="form-group">
          <div style='text-align:center;margin-top:10px; margin-bottom: 25px;'>
              @if($wedstrijd->status == 1)
                <input type='checkbox' id='show' name='status' checked onclick="showHide()">
              @else
                <input type='checkbox' id='show' name='status' onclick="showHide()">
              @endif
              <label for='show'>wedstrijd gespeeld</label>
          </div>
          <div class='row'>
            <div class='col-md-offset-1 col-md-4'>
              <span>
                <div class="col-md-8">
                  <!-- readonly ipv disabled zodat de value nog word verzonden -->
                    <input hidden readonly name='team1' value='{{ $wedstrijd->teams[0]->id }}' style="width: 100%;">
                    <input class="form-control" disabled value='{{ $wedstrijd->teams[0]->naam }}' style="width: 100%;">
                </div>
                <div class='col-md-4'>
                  <input class="form-control" id="team1_score" name='team1_score' value='{{ $wedstrijd->team1_score }}' min='0' type="number" 
                  @if($wedstrijd->status == 1)
                    style='display:block'>
                  @else 
                    style='display:none'>
                  @endif
                </div>
              </span>
            </div>
            <div class='col-md-2' style='text-align: center;'> vs </div>
            <div class='col-md-4'>
              <span>
                <div class='col-md-4'>
                  <input class="form-control" id="team2_score" name='team2_score' value="{{ $wedstrijd->team2_score }}" min='0' type="number" 
                  @if($wedstrijd->status == 1)
                    style='display:block'>
                  @else 
                    style='display:none'>
                  @endif 
                </div>
                <div class="col-md-8">
                  <input class="form-control" disabled value='{{ $wedstrijd->teams[1]->naam }}' style="width: 100%;">
                  <input hidden readonly name='team2' value='{{ $wedstrijd->teams[1]->id }}' style="width: 100%;">
                </div>
              </span>
            </div>
          </div>
        </div>     
      <!-- /.box-body -->
      <br>
      <div class="form-group col-md-offset-5 col-md-2" id='datum' style='text-align:center'>
          <label >Datum wedstrijd</label>
          <input class="form-control" name='gespeeld_op' type="date" value='{{ $wedstrijd->gespeeld_op }}'>
      </div>
      <br>
      </div>
      <div class="box-footer" style='text-align:center;'>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a type="button" href="{{ route('wedstrijden.index') }}" class="btn btn-warning">Terug</a>
      </div>
    </form>
  </div>
</div>
@else 
<div class="content-wrapper">
  <!-- general form elements -->
  <div class="box box-primary">
    <div class='well' style='text-align:center; background-color:red'>
      Het seizoen is geëindigd en dus is het niet mogelijk om een wedstrijd aan te passen.
    </div>
  </div>
</div>
@endif
@endsection

@section('footerSection')
<script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
@endsection