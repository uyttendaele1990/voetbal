@section('bg-img', asset('user/img/home-bg.jpg'))

@section('title', Auth::user()->name )

@section('subtitle', 'Welkom')

@extends('user/layouts/app')
<!-- de main content sectie openen en erin zetten wat je wil tonen op deze pagina -->
@section('headSection')
<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
<meta charset=utf-8 />
<!--[if IE]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!-- <script>
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
</script> -->
@endsection
@section('main-content')
<div class="container" style='text-align:center;'>
  {{ Auth::user()->name }}
  <div>
    <a class='btn btn-primary' href='{{route("profile.edit", Auth::user()->id)}}'>Profiel aanpassen </a>
  </div>
</div>
<!-- en de sectie niet vergeten sluiten -->
@endsection