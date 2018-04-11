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
@endsection
@section('main-content')
<div class="container" style='text-align:center;'>
 <label> {{ Auth::user()->name }}</label>
  <br>
  <br>
  @if(Auth::user()->google)
  <div class="well" style='color:red'> Gelieve uw wachtwoord aan te passen, u hebt een random wachtwoord gekregen</div>
  @endif
  <div>
    <a class='btn btn-primary' href='{{route("profile.edit", Auth::user()->id)}}'>Profiel aanpassen </a>
  </div>
</div>
<!-- en de sectie niet vergeten sluiten -->
@endsection