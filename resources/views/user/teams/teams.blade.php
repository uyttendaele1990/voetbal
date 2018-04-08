@extends('user/layouts/app')
@section('headSection')
<!-- ik kreeg mijn emails niet in orde, lang op zitten sukkelen met for loops en foreachs geprobeerd maar ik kreeg het niet zoals ik het wou, uiteindelijk maar besloten om het overtollige gewoon onzichtbaar te maken... -->
<style>
#example1 > tbody:nth-child(2) > tr:nth-child(1) > td:nth-child(5) {
  display:none;
}
#example1 > tbody:nth-child(2) > tr:nth-child(2) > td:nth-child(5) {
  display:none;
}
#example1 > tbody:nth-child(2) > tr:nth-child(3) > td:nth-child(5) {
  display:none;
}
#example1 > tbody:nth-child(2) > tr:nth-child(4) > td:nth-child(5) {
  display:none;
}
#example1 > tbody:nth-child(2) > tr:nth-child(5) > td:nth-child(5) {
  display:none;
}
#example1 > tbody:nth-child(2) > tr:nth-child(6) > td:nth-child(5) {
  display:none;
}
#example1 > tbody:nth-child(2) > tr:nth-child(7) > td:nth-child(5) {
  display:none;
}
#example1 > tbody:nth-child(2) > tr:nth-child(8) > td:nth-child(5) {
  display:none;
}
</style>
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
                  </tr>
                </thead>
                <tbody>
                  @foreach ($teams as $team)
                    <tr>
                      <td>{{ $loop->index+1 }}</td>
                      <td><a href="/teams/{{ $team->id }}">{{ $team->naam }}</a></td>
                      <td><img src="/storage/{{ $team->logo }}" style='width:40px; height:40px; float:left;'></td>
                      @for ($i=0; $i < count($users) ; $i++)
                      @if($users[$i]->teams_id == $team->id)
                       <td>
                       <form id='delete-form-{{$team->id}}' action="{{ route('email.destroy', $team->id) }}" method='post' style='display:none;'>
                        {{ csrf_field() }}
                        {{ method_field('DELETE')}}
                       </form>
                        <a href="{{ route('wedstrijden.index')}}" onclick="
                            if(confirm('Ben je zeker dat je deze ploeg niet meer wilt volgen?'))
                            {
                              event.preventDefault();
                              // het id meegeven
                              document.getElementById('delete-form-{{$team->id }}').submit();
                            }
                            else{
                              event.preventDefault();
                            }">
                          <span class="glyphicon glyphicon-envelope" style='color:green'></span>
                        </a>
                      </td>
                    
                      @endif
                      @endfor
                      <td><a href="/email/{{ $team->id}}"><span class="glyphicon glyphicon-envelope"></span></a></td>
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
 <!--  @if(App\Model\user\Email::where('users_id', Auth::user()->id)->first())
                        @if(App\Model\user\Email::where('teams_id', $team->id)->first())                   
                      

                      @else
                      <td><a href="/email/{{ $team->id}}"><span class="glyphicon glyphicon-envelope"></span></a></td>
                      @endif
                      @else
                      <td><a href="/email/{{ $team->id}}"><span class="glyphicon glyphicon-envelope"></span></a></td>
                      @endif -->