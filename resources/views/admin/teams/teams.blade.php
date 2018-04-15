
@extends('admin/layouts/app2')
@section('headSection')
<link class="jsbin" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/html" />
<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
<style>
  #test{
    display: none;
  }
</style>
<script>
       function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#test')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(150);
                };
                document.getElementById('test').style.display = 'block';

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
@endsection
@section('main-content')
<div class="content-wrapper">
  <!-- general form elements -->
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Teams</h3>
    </div>
    @include('includes.messages')
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="{{ route('teams.store') }}" method='post' enctype="multipart/form-data">
      {{ csrf_field() }}
      {{ method_field('POST') }}
      <div class="box-body">
        <div class='col-md-offset-5 col-md-2' style='text-align: center;' >
          <div class="form-group">
            <label for="team">Team naam</label>
            <input class="form-control" name='naam' placeholder="Fc De Kampioenen" type="text">
          </div>
          <div class="form-group">
            <label for="intialen">Afkorting</label>
            <input class="form-control" name='slug' placeholder="FC DK" type="text">
          </div>
          <div class="form-group">
            <label for="exampleInputFile">Logo</label>
            <img src="" id="test" alt='Logo' style='width:150px; height:150px; float:center;margin-top: 15px; margin-bottom: 15px;'>
            <input id="image" name='image' onchange="readURL(this)" type="file"> 
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer" style='text-align: center;'>
        <button type="submit" class="btn btn-primary">Verzenden</button>
        <a type="button" href="{{ route('teams.index') }}" class="btn btn-warning">Terug</a>
      </div>
    </form>
  </div>
</div>
@endsection