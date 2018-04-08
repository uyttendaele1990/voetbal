
<!-- dit is de header die op elke pagina van de admin side gebruikt zal worden -->
  <header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>V</b>T</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Voetbal</b>Tracker</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="/storage/{{Auth::user()->avatar}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ ucfirst(Auth::user()->naam)}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="/storage/{{Auth::user()->avatar}}" class="img-circle" alt="User Image">

                <p>
                  {{ ucfirst(Auth::user()->naam) }}
                  <small>Member since {{Auth::user()->created_at->toFormattedDateString()}}</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                    <a class="btn btn-default btn-flat" href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                    </form>
                </div>
              </li>
            </ul>
          </li>
         </ul>
      </div>
    </nav>
    @section('headerSection')
   @show
  </header>
<!-- zie footerSection en headSection :P -->