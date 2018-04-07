@extends('admin/layouts/app')
@section('headSection')
  <!-- datatables css enkel in deze file inladen-->
  <link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('main-content')
<div class="content-wrapper">
  <!-- general form elements -->
  <div class="box box-primary">
    <div class="box-header" style='text-align:center;'>
       <a class='btn btn-success' href='{{ route("wedstrijden.create") }}'>Wedstrijd toevoegen</a>
    </div>
    <div class="box-header with-border">
       <div>
         <h2 class="box-title" style='margin: 5px';>Gespeelde wedstrijden</h2>
       </div>
       <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <td>Nr</td>
                  <th>Team1</th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th>Team2</th>
                  <th>Opmerkingen</th>
                  <th>Akties</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($wedstrijden as $wedstrijd)
                  @if ($wedstrijd->status == 1)
                  <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $teams->where('id', $wedstrijd->team1_id)->first()->naam }}</td>
                    <td style='text-align:center;'>{{ $wedstrijd->team1_score }}</td>
                    <td style='text-align:center;'>vs</td>
                    <td style='text-align:center;'>{{ $wedstrijd->team2_score }}</td>
                    <td>{{ $teams->where('id', $wedstrijd->team2_id)->first()->naam }}</td>
                    <td>
                     @if(App\Model\admin\opmerkingen::where('wedstrijdens_id', $wedstrijd->id)->first())
                        <form id='delete-form-{{$wedstrijd->id}}' action="{{ route('opmerkingen.destroy', $wedstrijd->id) }}" method='post' style='display:none;'>
                        {{ csrf_field() }}
                        {{ method_field('DELETE')}}
                      </form>
                      <a href="{{ route('wedstrijden.index')}}" onclick="
                        if(confirm('Ben je zeker dat je de opmerking wilt deleten?'))
                          {
                            event.preventDefault();
                            // het id meegeven
                            document.getElementById('delete-form-{{$wedstrijd->id }}').submit();
                          }
                          else{
                            event.preventDefault();
                          }">
                        <span class="glyphicon glyphicon-trash"></span>
                      </a>
                     @else
                        <a href="wedstrijden/opmerkingen/{{$wedstrijd->id}}">
                            <span class="glyphicon glyphicon-plus"></span>
                        </a>
                      @endif
                    </td>
                    <td>
                      <a href="{{ route('wedstrijden.edit', $wedstrijd->id) }}">
                        <span class="glyphicon glyphicon-edit"></span>
                      </a>
                      <form id='delete-form-{{$wedstrijd->id}}' action="{{ route('wedstrijden.destroy', $wedstrijd->id) }}" method='post' style='display:none;'>
                        {{ csrf_field() }}
                        {{ method_field('DELETE')}}
                      </form>
                      <a href="{{ route('wedstrijden.index')}}" onclick="
                        if(confirm('Ben je zeker dat je deze wedstrijd wilt deleten?'))
                          {
                            event.preventDefault();
                            // het id meegeven
                            document.getElementById('delete-form-{{$wedstrijd->id }}').submit();
                          }
                          else{
                            event.preventDefault();
                          }">
                        <span class="glyphicon glyphicon-trash"></span>
                      </a>
                    </td>    
                  </tr>
                  @endif
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
       </div>
    </div>
  </div>
  <div class="box box-primary">
    <div class="box-header with-border">
      <div>
         <h2 class="box-title" style='margin: 5px';>Komende wedstrijden</h2>
      </div>    
    <div class="box">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <td>Nr</td>
                  <th style='text-align:right'>Team1</th>
                  <th></th>
                  <th>Team2</th>
                  <th>Akties</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($wedstrijden as $wedstrijd)
                  @if ($wedstrijd->status == 0)
                  <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td style='text-align:right'>{{ $teams->where('id', $wedstrijd->team1_id)->first()->naam }}</td>
                    <td style='text-align:center;'>vs</td>
                    <td>{{ $teams->where('id', $wedstrijd->team2_id)->first()->naam }}</td>
                    <td>
                      <a href="{{ route('wedstrijden.edit', $wedstrijd->id) }}">
                        <span class="glyphicon glyphicon-edit"></span>
                      </a>
                      <form id='delete-form-{{$wedstrijd->id}}' action="{{ route('wedstrijden.destroy', $wedstrijd->id) }}" method='post' style='display:none;'>
                        {{ csrf_field() }}
                        {{ method_field('DELETE')}}
                      </form>
                      <a href="{{ route('wedstrijden.index')}}" onclick="
                        if(confirm('Ben je zeker dat je deze wedstrijd wilt deleten?'))
                          {
                            event.preventDefault();
                            // het id meegeven
                            document.getElementById('delete-form-{{$wedstrijd->id }}').submit();
                          }
                          else{
                            event.preventDefault();
                          }">
                        <span class="glyphicon glyphicon-trash"></span>
                      </a>
                    </td>    
                  </tr>
                  @endif
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