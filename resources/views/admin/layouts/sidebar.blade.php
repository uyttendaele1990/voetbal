<!-- 3 maal raden ... Dit is de sidebar die op elke pagina van de admin side gebruikt zal worden -->
 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img alt='{{ Auth::user()->name }}' src="/storage/{{Auth::user()->avatar}}" class="img-circle">
        </div>
        <div class="pull-left info">
          <p style='margin-top: 15px; margin-left: 15px'>{{Auth::user()->name}}</p>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" >
        <li class="header">Admin Panel</li>
        <li>
          <a href="{{ route('admin.home') }}">
            <i class="fa fa-home"></i> <span>Home</span>
          </a>
        </li>
        <li>
          <a href="{{ route('user.index') }}">
            <i class="fa fa-lock"></i> <span>Users</span>
          </a>
        </li>
        @if(Auth::user()->name == "admin")
        <li>
          <a href="{{ route('admin.index') }}">
            <i class="fa fa-lock"></i> <span>Admins</span>
          </a>
        </li>
        @endif
        @if((App\Model\admin\admin::where('seizoen', 1)->first()))
        <li>
          <a href="{{ route('teams.index') }}">
            <i class="fa fa-users"></i> <span>Teams</span>
          </a>
        </li>
        @endif
        <li>
          <a href="{{ route('spelers.index') }}">
            <i class="fa fa-user"></i> <span>Spelers</span>
          </a>
        </li>
        @if(!(App\Model\admin\admin::where('seizoen', 1)->first()))
        <li class="treeview">
          <a href="{{ route('wedstrijden.index') }}">
            <i class="fa fa-futbol-o"></i>
            <span>Wedstrijden</span>
          </a>
        </li>
        @endif
        <li>
          <a href="{{ route('stats.index') }}">
            <i class="fa fa-bar-chart"></i> <span>Statistieken</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form-sidebar').submit();">
            <i class="fa fa-fw fa-sign-out"></i><span>Logout</span></a>
        </li>
        <form id="logout-form-sidebar" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>