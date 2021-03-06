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
      <ol class="breadcrumb" style='text-align:center'>
        <li><a href="{{route('user.index')}}">Users</a></li>
        <li><a href="{{route('user.edit', $user->id)}}">Edit</a></li>
      </ol>
    </div>
    @include('includes.messages')
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action='{{ route("user.update", $user->id)}}' method='post' enctype='multipart/form-data'>
      <!-- na het openen van elke form in laravel moet je een csrf_field toevoegen -->
      {{ csrf_field() }}
      <!-- na de form moet je ook de mothode nog een toevoegen hier is het een PUT of PATCH (update) -->
      {{ method_field('PUT') }}
      <div class="box-body">
        <div class='col-md-offset-5 col-md-2' style='text-align: center;' >
        <div class="form-group">
          <label for="team">Naam</label>
          <br>
          <input class="form-control" value='{{$user->name}}'  name='name' type="text">
        </div>
        <div class="form-group">
          <label for="team">Email</label>
          <br>
          <input class="form-control"  name='email' value="{{$user->email}}" type="email">
        </div>
        <div class="form-group">
          <label>Foto</label>
          <br>
          <img src="/storage/{{ $user->avatar }}" id="test" style='width:150px; height:150px; float:left;border-radius:50%;margin-top: 15px; margin-bottom: 15px;'>
          <input id="image" name='avatar' onchange="readURL(this)" type="file" style='margin-bottom: 25px;'> 
        </div>
        <button type="submit" class="btn btn-primary">Verzenden</button>
      </div>
      </div>
      <!-- /.box-body -->

    </form>
  </div>
</div>
@endsection