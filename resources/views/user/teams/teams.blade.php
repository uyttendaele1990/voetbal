@extends('user/layouts/app')
@section('headerSection')

@endsection
@section('bg-img', asset('user/img/teams-bg.jpg'))

@section('title', 'Teams')

@section('subtitle', 'Uw favoriete teams')
@section('main-content')
<div class="content-wrapper">
  <!-- general form elements -->
  <div class='container'>
  <div class="box box-primary">
    <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Nr</th>
                    <th>Naam</th>
                    <th>Logo</th>
                    <th>Volg</th>
                    <th>Like</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($teams as $team)
                    <tr>
                      <td>{{ $loop->index+1 }}</td>
                      <td><a href="/teams/{{ $team->id }}">{{ $team->naam }}</a></td>
                      <td><img src="/storage/{{ $team->logo }}" style='width:40px; height:40px; float:left;'></td>
                      <td><a href=''><span class="glyphicon glyphicon-envelope"></span></a></td>
                      <td><a href=""><span class="glyphicon glyphicon-thumbs-up"></span></a></td>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    </div>
</div>
</div>
@endsection

@section('footerSection')

@endsection