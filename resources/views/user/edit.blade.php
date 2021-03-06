@section('bg-img', asset('user/img/home-bg.jpg'))

@section('title', 'Profiel pagina' )

@section('subtitle', Auth::user()->name)

@extends('user/layouts/app')
<!-- de main content sectie openen en erin zetten wat je wil tonen op deze pagina -->
@section('headSection')
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
<div class="container">
  <!-- general form elements -->
    @include('includes.messages')
    <!-- /.box-header -->
    <!-- form start -->
    <!-- enctype='multipart/form-data' zodat je je image file kunt PUTTEN (PATCHEN (updaten))  -->
    <form role="form" action='{{ route("profile.update", Auth::user()->id)}}' method='post' enctype='multipart/form-data'>
      <!-- na het openen van elke form in laravel moet je een csrf_field toevoegen -->
      {{ csrf_field() }}
      <!-- na de form moet je ook de mothode nog een toevoegen hier is het een PUT of PATCH (update) -->
      {{ method_field('PUT') }}
      <div class="box-body">
        <div class='col-md-offset-5 col-md-2' style='text-align: center;' >
        <div class="form-group">
          <label for="team">Naam</label>
          <br>
          <input class="form-control" name='name' value="{{ $user->name }}" type="text">
        </div>
        <div class="form-group">
          <label for="team">Email</label>
          <br>
          <input class="form-control"  name='email' value="{{ $user->email }}" type="email">
        </div>
        <input type='checkbox' id='check' name="check" value='1' onclick='wachtwoord()'><small>Wachtwoord veranderen</small>
        <div class="form-group">
          <input class="form-control" id='pw1' disabled name='password' placeholder="wachtwoord" type="password">
        </div> 
        <div class="form-group">
          <input class="form-control" id='pw2' disabled name='password_confirmation' placeholder="wachtwoord bevestigen" type="password">
        </div>
        <div class="form-group">
          <label>Foto</label>
          <br>
          <img src="/storage/{{ $user->avatar }}" alt='{{ $user->name }}' id="test" style='width:150px; height:150px; float:left;border-radius:50%;margin-top: 15px; margin-bottom: 15px;'>
          <input id="image" name='avatar'  value='{{ $user->avatar }' onchange="readURL(this)" type="file" style='margin-bottom: 25px;'> 
        </div>
        <button type="submit" class="btn btn-primary">Verzenden</button>
      </div>
      </div>
      <!-- /.box-body -->

    </form>
    <a href="#" class="back-to-top"><i class="glyphicon glyphicon-chevron-up"></i></a>
  </div>
<!-- en de sectie niet vergeten sluiten -->
@endsection
