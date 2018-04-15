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
      <h2 class="box-title">Spelers</h2>
      
      <button type='button' class='btn btn-box-tool' data-widget='collapse' data-toggle='tooltip' title='Collapse'>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <div class="box">
            <div class="box-header">
              <a class='col-md-offset-5 btn btn-success' href='{{ route("spelers.create") }}'>Speler Toevoegen</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <!-- table headers -->
                  <th>Nr</th>
                  <th>naam</th>
                  <th>Foto</th>
                  <th>Club</th>
                  <th>Acties</th>
                </tr>
                </thead>
                <tbody>
                  <!-- een foreachke zodat je de info van alle spelers krijgt uit de db -->
                @foreach ($spelers as $speler)
                  <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $speler->naam }}</td>
                    <td><img src="/storage/{{ $speler->foto }}" alt='{{ $speler->naam }}' style='width:75px; height:75px; float:left;border-radius:50%;'></td>
                    <td>{{ $speler->teams->naam }}</td>
                    <td>
                      <!-- de edit button -->
                      <a href="{{ route('spelers.edit', $speler->id) }}">
                        <span class="glyphicon glyphicon-edit"></span>
                      </a>
                      <!-- de delete button, hier heb je een form nodig omdat je de methode delete moet aanroepen en je moet ook een id meegeven zodat je methode delete weet waar het moet gaan deleten daarom dat id='delete-form-{{$speler->id}}' -->
                      <form id='delete-form-{{$speler->id}}' action="{{ route('spelers.destroy', $speler->id) }}" method='post' style='display:none;'>
                        {{ csrf_field() }}
                        <!-- delete methode toevoegen aan je form -->
                        {{ method_field('DELETE')}}
                      </form>
                      <!-- speler deleten, js die confirmatie wil, en event.preventDefault die ervoor zorgt dat er nix gedaan word als je op de pagina blijft (dat is wanneer de confirm op pupt en wanneer je anuleert) -->
                      <a href="{{ route('spelers.index')}}" onclick="
                        if(confirm('Ben je zeker dat je deze speler wilt deleten?'))
                          {
                            event.preventDefault();
                            // het id meegeven
                            document.getElementById('delete-form-{{$speler->id }}').submit();
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
                  <!-- de table footer (tableheader :P ) -->
                  <th>Id</th>
                  <th>Naam</th>
                  <th>Foto</th>
                  <th>Club</th>
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