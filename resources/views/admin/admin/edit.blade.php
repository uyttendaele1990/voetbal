@if(Auth::user()->name == "admin" || Auth::user()->id == $user->id )
@extends('admin/layouts/app')
@section('headSection')
<link class="jsbin" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
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

        function wachtwoord(){
            if(document.getElementById('check').checked){
                  document.getElementById('pw1').disabled = false;
                  document.getElementById('pw2').disabled = false;
            }  else  {
                  document.getElementById('pw1').disabled = true;
                  document.getElementById('pw2').disabled = true;
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
        <li><a href="{{route('admin.index')}}">Admin</a></li>
        <li><a href="{{route('admin.edit', $user->id)}}">Edit</a></li>
      </ol>
    </div>
    @include('includes.messages')
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action='{{ route("admin.update", $user->id)}}' method='post' enctype='multipart/form-data'>
      <!-- na het openen van elke form in laravel moet je een csrf_field toevoegen -->
      {{ csrf_field() }}
      <!-- na de form moet je ook de mothode nog een toevoegen hier is het een PUT of PATCH (update) -->
      {{ method_field('PUT') }}
      <div class="box-body">
        <div class='col-md-offset-5 col-md-2' style='text-align: center;' >
        <div class="form-group">
          <label for="team">Naam</label>
          <br>
          <input class="form-control" @if($user->name == 'admin') readonly @endif value='{{$user->name}}'  name='name' type="text">
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
        <input type='checkbox' id='check' name="check" value='1' onclick='wachtwoord()'>  <label for='check'>Wachtwoord veranderen</label>
        <div class="form-group">
          <input class="form-control" id='pw1' disabled name='password' placeholder="wachtwoord" type="password">
        </div> 
        <div class="form-group">
          <input class="form-control" id='pw2' disabled name='password_confirmation' placeholder="wachtwoord herhalen" type="password">
        </div>
        @if($user->name == 'admin')
          <div><input type='checkbox' id='seizoen' name='seizoen' @if($user->seizoen == 1) checked @endif >  <label for='seizoen'>Seizoen geïndigd</label> </div>
        @endif
        <br>
        <button type="submit" class="btn btn-primary">Verzenden</button>
      </div>
      </div>
      <!-- /.box-body -->

    </form>
    @if($user->name == 'admin')
          <center>
            <form id='delete-form' action="{{ route('wedstrijden.destroy', -2) }}" method='post' style='display:none;'>
                        {{ csrf_field() }}
                        <!-- delete methode toevoegen aan je form -->
                        {{ method_field('DELETE')}}
                      </form>    
            <a href='' style='padding-right:23px;padding-left:24px;margin-bottom: 15px;' class='btn btn-danger' onclick="if(confirm('Ben je zeker dat je een nieuw seizoen wilt starten?')){
                                                      event.preventDefault();if(confirm('Alle wedstrijden, goalen en punten zullen gedeletet worden, bent u het zeker?')){
                                                      event.preventDefault();
                                                      // het id meegeven
                                                      document.getElementById('delete-form').submit();
                                                      }event.preventDefault();
                                                      } else {
                                                      event.preventDefault();
                                                      }">
            Nieuw seizoen</a>
          </center>
          @endif
  </div>
</div>
@endsection
@else
@section('main-content')
<div class="content-wrapper">
  <div class='well' style='background:red'> U hebt geen toestemming om op deze pagina te komen </div>
  <center><a class='btn btn-danger' href='../../home'>Home</a></center>
</div>
@endsection
@endif