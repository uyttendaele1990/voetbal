    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav" >
      <div class="container">
        <a class="navbar-brand" href="/index">Voetbal Tracker</a>
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
             <li class="nav-item">
              <a class="nav-link" href="/teams">Teams</a>
             </li>
             <li class="nav-item">
                <a class="nav-link" href="/home">{{ Auth::user()->name }}</a>
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