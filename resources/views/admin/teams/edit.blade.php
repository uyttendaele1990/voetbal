@extends('admin/layouts/app')
@section('headSection')
<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
<meta charset=utf-8 />
<!--[if IE]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
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
      <h3 class="box-title">Teams</h3>
    </div>
    <!-- errors weergeven  -->
    @include('includes.messages')
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="{{ route('teams.update', $teams->id) }}" method='post' enctype='multipart/form-data'>
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <div class="box-body">
        <div class='col-md-offset-5 col-md-2' style='text-align: center;' >
        <div class="form-group">
          <label for="team">Team naam</label>
          <input class="form-control" name='naam' readonly type="text" value="{{ $teams->naam }}">
        </div>
        <div class="form-group">
          <label for="intialen">Afkorting</label>
          <input class="form-control" name='slug' type="text" value="{{ $teams->slug }}">
        </div>
        <div class="form-group">
          <label for="exampleInputFile">Logo</label>
          <div><img src="/storage/{{ $teams->logo }}" id='test' style='width:150px; height:150px; float:left;'></div>
          <input name='image' onchange="readURL(this)" type="file">
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