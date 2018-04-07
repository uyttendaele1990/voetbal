@extends('admin/layouts/app')
@section('headSection')
  <!-- datatables css enkel in deze file inladen-->
  <link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('main-content')
<div class="content-wrapper">
  <!-- general form elements -->
  <div class="box box-primary">
    <div class="box-header with-border">
      <h2 class="box-title";>Teams</h2>      
      <button type='button' class='btn btn-box-tool' data-widget='collapse' data-toggle='tooltip' title='Collapse'>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <div class="box">
            <div class="box-header">
              <a class='col-md-offset-5 btn btn-success' href='{{ route("teams.create") }}'>Team Toevoegen</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Nr</th>
                    <th>Team naam</th>
                    <th>Logo</th>
                    <th>Afkorting</th>
                    <th>Acties</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($teams as $team)
                    <tr>
                      <td>{{ $loop->index+1 }}</td>
                      <td>{{ $team->naam }}</td>
                      <td><img src="/storage/{{ $team->logo }}" style='width:40px; height:40px; float:left;'></td>
                      <td>{{ $team->slug }}</td>
                      <td>
                        <a href="{{ route('teams.edit', $team->id) }}">
                            <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <form id='delete-form-{{$team->id}}' action="{{ route('teams.destroy', $team->id) }}" method='post' style='display:none;'>
                            {{ csrf_field() }}
                            {{ method_field('DELETE')}}
                        </form>
                        <a href="{{ route('teams.index')}}" onclick="
                            if(confirm('Ben je zeker dat je dit team wilt deleten?'))
                                {
                                  event.preventDefault();
                                  document.getElementById('delete-form-{{$team->id }}').submit();
                                }
                                else{
                                  event.preventDefault();
                                }">
                            <span class="glyphicon glyphicon-trash"></span>
                        </a>
                      </td>  
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                    <tr>
                      <th>Id</th>
                      <th>Team naam</th>
                      <th>Logo</th>
                      <th>Afkorting</th>
                      <th>Acties</th>
                    </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    </div>
</div>
@endsection

@section('footerSection')
<!-- alles inladen wat enkel op deze pagina gebruikt zal worden -->
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