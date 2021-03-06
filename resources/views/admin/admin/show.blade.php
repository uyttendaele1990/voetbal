@if(Auth::user()->name == "admin")
@extends('admin/layouts/app')
<!-- deze head section word enkel geladen voor deze pagina in de head -->
@section('headSection')
  <!-- datatables css-->
  <link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('main-content')
<div class="content-wrapper">
  <!-- general form elements -->
  <div class="box box-primary">
    <div class="box-header with-border">
      <ol class="breadcrumb" style='text-align:center'>
        <li><a href="{{route('admin.index')}}">Admin</a></li>
      </ol>
      
      <button type='button' class='btn btn-box-tool' data-widget='collapse' data-toggle='tooltip' title='Collapse'>
    </div>
     <div class="box-header">
              <a class='col-md-offset-5 btn btn-success' href='{{ route("admin.create") }}'>Admin Toevoegen</a>
            </div>
    <!-- /.box-header -->
    <!-- form start -->
    <div class="box">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <!-- table headers -->
                  <th>Nr</th>
                  <th>Naam</th>
                  <th>Email</th>
                  <th>Avatar</th>
                  <th>Acties</th>
                </tr>
                </thead>
                <tbody>
                  <!-- een foreachke zodat je de info van alle spelers krijgt uit de db -->
                @foreach ($users as $user)
                  <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><img src="/storage/{{ $user->avatar }}" style='width:75px; height:75px; float:left;border-radius:50%;'></td>
                    
                    <td>
                      <!-- de edit button -->
                      <a href="{{ route('admin.edit', $user->id) }}">
                        <span class="glyphicon glyphicon-edit"></span>
                      </a>
                      @if($user->name !== 'admin')
                      <form id='delete-form-{{$user->id}}' action="{{ route('admin.destroy', $user->id) }}" method='post' style='display:none;'>
                        {{ csrf_field() }}
                        <!-- delete methode toevoegen aan je form -->
                        {{ method_field('DELETE')}}
                      </form>
                      <a href="{{ route('admin.index')}}" onclick="
                        if(confirm('Ben je zeker dat je deze admin wilt deleten?'))
                          {
                            event.preventDefault();
                            // het id meegeven
                            document.getElementById('delete-form-{{$user->id }}').submit();
                          }
                          else{
                            event.preventDefault();
                          }">
                        <span class="glyphicon glyphicon-trash"></span>
                      </a>
                      @endif
                    </td>  
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>            
            <!-- /.box-body -->
          </div>
    </div>
</div>
@endsection
<!-- deze footer word enkel voor deze pagina geladen in de footer -->
@section('footerSection')

<!-- DataTables -->
<script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

@endsection
@else
@section('main-content')
<div class="content-wrapper">
  <div class='well' style='background:red'> U hebt geen toestemming om op deze pagina te komen </div>
  <center><a class='btn btn-danger' href='../admin/home'>Home</a></center>
</div>
@endsection
@endif