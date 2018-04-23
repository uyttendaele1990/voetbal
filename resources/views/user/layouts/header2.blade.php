   <!-- Navigation -->
    <nav class="navbar navbar-expand-sm navbar-light fixed-top" id="mainNav" >
      <div class="container">
        <a class="navbar-brand" href="/"><img src="{{asset('user/img/vt.png')}}" style='height:65px; width:65px'></a>
         <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/stats">Statistieken</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/wedstrijden">Wedstrijden</a>
            </li>
            @guest
              <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Registreer</a>
              </li>
            @else
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Teams
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/teams">Teams</a>
                @foreach(App\Model\admin\teams::all() as $team)
                  <a class="dropdown-item" href="/teams/{{$team->id}}">{{$team->naam}}</a>
                @endforeach
              </div>
            </li>
             <li class="nav-item">
                <a class="nav-link" href="{{ route('profile.edit', Auth::user()->id)}}">{{ Auth::user()->name }}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
              </li>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
              </form>
            @endguest
          </ul>
        </div>
      </div>
    </nav>

    <header>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <!-- Slide One - Set the background image for this slide in the line below -->
          <div class="carousel-item active" style="background-image:url('{{asset('user/img/slide-2.jpg')}}')">
            <div class="carousel-caption d-none d-md-block">
              <h3><a href="#" class="pull-left"><img src="{{asset('user/img/vt.png')}}" style='height:245px; width:245px'></a></h3>
              <p>Volg jouw team</p>
            </div>
          </div>
          <!-- Slide Two - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image:url('{{asset('user/img/slide-1.jpg')}}')">
            <div class="carousel-caption d-none d-md-block">
              <h3><a href="#" class="pull-left"><img src="{{asset('user/img/vt.png')}}" style='height:245px; width:245px;'></a></h3>
              <p>Voor de trouwe supporter</p>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
</header>