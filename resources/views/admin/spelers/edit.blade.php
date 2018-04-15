<!-- de map app extenden die de basis vormt van alle paginas aan de admin side -->
@extends('admin/layouts/app2')
<!-- de main content sectie openen en erin zetten wat je wil tonen op deze pagina -->
@section('headSection')
<link class="jsbin" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/html" />
<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
<meta charset=utf-8 />
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
    <!-- enctype='multipart/form-data' zodat je je image file kunt PUTTEN (PATCHEN (updaten))  -->
    <form role="form" action="{{ route('spelers.update', $spelers->id) }}" method='post' enctype='multipart/form-data'>
      <!-- na het openen van elke form in laravel moet je een csrf_field toevoegen -->
      {{ csrf_field() }}
      <!-- na de form moet je ook de mothode nog een toevoegen hier is het een PUT of PATCH (update) -->
      {{ method_field('PUT') }}
      <div class="box-body">
        <div class='col-md-offset-5 col-md-2' style='text-align: center;' >
        <div class="form-group">
          <label for="team">Naam</label>
          <br>
          <input class="form-control" readonly id="naam" name='naam' value="{{ $spelers->naam }}" type="text">
        </div>
        <div class="form-group">
          <label>Foto</label>
          <br>
          <img src="/storage/{{ $spelers->foto }}" alt='{{ $spelers->naam }}' id="test" style='width:150px; height:150px; float:left;border-radius:50%;margin-top: 15px; margin-bottom: 15px;'>
          <input id="image" name='foto' onchange="readURL(this)" type="file"> 
        </div>
        <div class="form-group">
          <label>Ploeg naam</label>
          <!-- dropdown  -->
          <select class="form-control" name='teams_id' style="width: 100%;">
            <!-- hier worden al de teams opgelijst in de dropdown zodat je enkel bestaande teams kunt invoegen -->
                      <option value='{{ $spelers->teams_id }}'>{{ $spelers->teams->naam }}</option>
                  @foreach ($teams as $team)
                    @if ($spelers->teams->naam !== $team->naam)
                      <option value='{{$team->id}}'>{{$team->naam}}</option>
                    @endif
                  @endforeach
          </select>
        </div>
      </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer" style='text-align: center;'>
        <button type="submit" class="btn btn-primary">Verzenden</button>
        <!-- terug naar de spelers index page -->
        <a type="button" href="{{ route('spelers.index') }}" class="btn btn-warning">Terug</a>
      </div>
    </form>
  </div>
</div>
<!-- en de sectie niet vergeten sluiten -->
@endsection


