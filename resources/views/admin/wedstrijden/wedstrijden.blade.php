@extends('admin/layouts/app')
@section('headSection')
<!-- javascript functie -->
<script>
  function showHide(){
    // indien de checkboxed is aangeklikt
  if(document.getElementById('show').checked){
    // veranderd de display van desbetreffend block naar block ipv none (dus word zichtbaar)
    // en de value veranderd naar 0 ipv een placeholder van 0 zodat de validation rule van required eigenlijk een beetje overkill is maar ik laat die liever staan, het zekere voor het onzekere nemen
    document.getElementById('team1_score').style.display='block';
    document.getElementById('team2_score').style.display='block';
    document.getElementById('team1_score').value='0';
    document.getElementById('team2_score').value='0';
  }  else  {
    // indien de checkbox afgeklikt word alles terug onzichtbaar maken en values op null zetten zodat er niet per ongelukt verkeerde data word doorgegeven
    document.getElementById('team1_score').style.display='none';
    document.getElementById('team2_score').style.display='none';
    document.getElementById('team1_score').value= null;
    document.getElementById('team2_score').value= null;
  }
}
</script>
@endsection
@section('main-content')
<div class="content-wrapper">
  <!-- general form elements -->
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Wedstrijden</h3>
    </div>
    @include('includes.messages')
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="{{ route('wedstrijden.store') }}" method='post'>{{ csrf_field() }}
      <div class="box-body">
        <div class="form-group">
          <div style='text-align:center;margin-top:10px; margin-bottom: 25px;'>
            <input type='checkbox' name='status' id='show' onclick="showHide()">
            <label for='show'>wedstrijd gespeeld</label>
          </div>
          <div class='row'>
            <div class='col-md-offset-1 col-md-4'>
              <span>
                <div class="col-md-8">
                    <select class="form-control" name='team1' style="width: 100%;">
                    @foreach ($teams as $team)
                      <option value='{{$team->id}}'>{{$team->naam}}</option>
                    @endforeach
                    </select>
                </div>
                <div class='col-md-4'>
                  <input class="form-control" id="team1_score" name='team1_score' placeholder="0" type="number" min='0' style='display:none'> 
                </div>
              </span>
            </div>
            <div class='col-md-2' style='text-align: center;'> vs </div>
            <div class='col-md-4'>
              <span>
                <div class='col-md-4'>
                  <input class="form-control" id="team2_score" name='team2_score' placeholder="0" min='0' type="number" style='display:none'> 
                </div>
                <div class="col-md-8">
                    <select class="form-control" name='team2' style="width: 100%;">
                    @foreach ($teams as $team)
                      <option value='{{$team->id}}'>{{$team->naam}}</option>
                    @endforeach
                    </select>
                </div>
              </span>
            </div>
          </div>
        </div>     
      <!-- /.box-body -->
      <br>
      <div class="form-group col-md-offset-5 col-md-2" id='datum' style='text-align:center;'>
          <label >Datum wedstrijd</label>
          <input class="form-control" name='gespeeld_op' value='{{$date}}' type="date">
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
@endsection
