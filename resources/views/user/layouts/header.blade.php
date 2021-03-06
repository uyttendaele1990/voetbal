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
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Teams</a>
                <ul class="dropdown-menu" style='opacity:0.8;border-radius:4px'>
                  <li>
                    <a href="/teams">Teams</a>
                  </li>
                   @foreach(App\Model\admin\teams::all() as $team)
                      <li>
                      <a href="/teams/{{$team->id}}">{{$team->naam}}</a>
                      </li>
                   @endforeach
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('profile.edit', Auth::user()->id)}}">{{ Auth::user()->name }} <!-- <img src="/storage/{{Auth::user()->avatar}}" class="user-image" alt="User Image" style='height:40px; width:40px;border-radius:50%'> --></a>
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

    <!-- Page Header -->
    <header class="masthead" style="background-size:@yield('bg-size');background-image: url('@yield('bg-img')');background-color:white;">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <h1>@yield('title')</h1>
              <span class="subheading">@yield('subtitle')</span>
            </div>
          </div>
        </div>
      </div>
    </header>