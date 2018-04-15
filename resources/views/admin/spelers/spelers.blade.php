@extends('admin/layouts/app2')
@section('headSection')
<link class="jsbin" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/html" />
<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
<meta charset=utf-8 />
<title>JS Bin</title>
<!--[if IE]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<style>
  article, aside, figure, footer, header, hgroup, 
  menu, nav, section { display: block; }
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
      <h3 class="box-title">Spelers</h3>
    </div>
    @include('includes.messages')
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="{{ route('spelers.store') }}" method='post' enctype="multipart/form-data">
      {{ csrf_field() }}
      {{ method_field('POST') }}
      <div class="box-body">
        <div class='col-md-offset-5 col-md-2' style='text-align: center;' >
        <div class="form-group">
          <label for="team">Naam</label>
          <br>
          <input class="form-control" name='naam' placeholder="John Doe" type="text">
        </div>
        <div class="form-group">
          <label for="exampleInputFile">Foto</label>
          <br>
          <img src="/storage/foto/user-default.png" id="test" alt='Foto' style='width:150px; height:150px; float:left;border-radius:50%;margin-top: 15px; margin-bottom: 15px;'>
          <input id="image" name='foto' onchange="readURL(this)" type="file"> 
        </div>
        <br>
        <div class="form-group">
          <label>Ploeg naam</label>
          <br>
          <br>
          <select class="form-control" name='teams_id' style="width: 100%;">
                  @foreach ($teams as $team)
                      <option value='{{$team->id}}'>{{$team->naam}}</option>
                  @endforeach
          </select>
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