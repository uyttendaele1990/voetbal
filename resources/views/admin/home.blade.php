@extends('admin/layouts/app')
@section('headSection')
<!--chartjs cdn -->
    <style>
      .panel-heading{
        font-size: 20px;
      }
      .panel-body{
        padding: 50px;
/*         background-color: #E6E6E6; */
        background-color: rgba(0, 0, 0, 0);
      }
      .panel-default{
        background-color: rgba(0, 0, 0, 0);
        border-color: rgba(0, 0, 0, 0);
        padding: 0px;
        margin-top: 0px;
      }
        .box-shadow{
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0), 0 6px 20px 0 rgba(0, 0, 0, 0);
      }
      body{
        padding-top: 0px;
      }
@media (min-width: 768px){
.circle-tile {
    margin-bottom: 30px;
}
}

.circle-tile {
    margin-bottom: 15px;
    text-align: center;
}

.circle-tile-heading {
    position: relative;
    width: 80px;
    height: 80px;
    margin: 0 auto -40px;
    border: 3px solid rgba(255,255,255,0.3);
    border-radius: 100%;
    color: #fff;
    transition: all ease-in-out .3s;
}

/* -- Background Helper Classes */

/* Use these to cuztomize the background color of a div. These are used along with tiles, or any other div you want to customize. */

 .dark-blue {
    background-color: #34495e;
}
 .white {
    background-color: #EEEEEE;
}
.green {
    background-color: #16a085;
}

.blue {
    background-color: #2980b9;
}

.orange {
    background-color: #f39c12;
}

.red {
    background-color: #e74c3c;
}

.purple {
    background-color: #8e44ad;
}

.dark-gray {
    background-color: #7f8c8d;
}

.gray {
    background-color: #95a5a6;
}

.light-gray {
    background-color: #bdc3c7;
}

.yellow {
    background-color: #f1c40f;
}

/* -- Text Color Helper Classes */

 .text-dark-blue {
    color: #34495e;
}

.text-green {
    color: #16a085;
}

.text-blue {
    color: #2980b9;
}

.text-orange {
    color: #f39c12;
}

.text-red {
    color: #e74c3c;
}

.text-purple {
    color: #8e44ad;
}

.text-faded {
    color: rgba(255,255,255,0.7);
}

.circle-tile-heading .fa {
    line-height: 80px;
}

.circle-tile-content {
    padding: 50px 10px 10px 10px;
    border-radius: 10px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.3);
}
.circle-tile-description {
    text-transform: uppercase;
    font-weight: bold;
    font-family: "arial";
}

.text-faded {
    color: rgba(255,255,255,0.7);
}

.circle-tile-number {
    padding: 2px 0 5px;
    font-size: 26px;
    font-weight: 700;
    line-height: 1;
}

.circle-tile-footer {
    display: block;
    padding: 5px;
    color: rgba(255,255,255,0.5);
    background-color: rgba(0,0,0,0.1);
    transition: all ease-in-out .3s;
    border-radius: 25px;
}

.circle-tile-footer:hover {
    text-decoration: none;
    color: rgba(255,255,255,0.5);
    background-color: rgba(0,0,0,0.2);
}

.tile-img {
    text-shadow: 2px 2px 3px rgba(0,0,0,0.9);
}

.tile {
    margin-bottom: 15px;
    padding: 15px;
    overflow: hidden;
    color: #fff;
}
.top-pad-adj{
  padding-top: 15px;
}
.font-adj{
   text-transform: uppercase;
   font-size: 20px;
   font-weight: bold;
   font-family: "arial";
   color:#585858;
}
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
@endsection
@section('main-content')
		<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style='text-align:center'>
      <h1>
        {{Auth::user()->name}}
        <small>Welkom op de amin side</small>
      </h1>
     <!--  <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol> -->
    </section>
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <ol class="breadcrumb" style='text-align:center'>
            <li><a href="{{route('admin.home')}}">Dashboard</a></li>
          </ol>
        </div>
        <div class="box-body">
          <div class="row">
              <div class="col-lg-offset-2 col-lg-4 col-md-6">
                <div class="circle-tile">
                    <div class="circle-tile-heading green">
                        <i class="fa fa-user fa-fw fa-3x"></i>
                    </div>
                  <div class="circle-tile-content green">
                    <div class="circle-tile-description text-faded">
                        Spelers
                    </div>
                    <div class="circle-tile-number text-faded">
                        {{ App\Model\admin\Spelers::all()->count()}}
                        <span id="sparklineA"></span>
                    </div>
                    <a href="{{ route('spelers.index') }}" class="circle-tile-footer">Meer Info <i class="fa fa-chevron-circle-right"></i></a>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="circle-tile">
                    <div class="circle-tile-heading green">
                        <i class="fa fa-users fa-fw fa-3x"></i>
                    </div>
                  <div class="circle-tile-content green">
                    <div class="circle-tile-description text-faded">
                        Teams
                    </div>
                    <div class="circle-tile-number text-faded">
                        {{ App\Model\admin\Teams::all()->count()}}
                        <span id="sparklineA"></span>
                    </div>
                    <a href="{{ route('teams.index') }}" class="circle-tile-footer">Meer Info <i class="fa fa-chevron-circle-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-offset-2 col-lg-4 col-md-6">
                <div class="circle-tile">
                    <div class="circle-tile-heading blue">
                        <i class="fa fa-futbol-o fa-fw fa-3x"></i>
                    </div>
                  <div class="circle-tile-content blue">
                    <div class="circle-tile-description text-faded">
                        Wedstrijden gespeeld
                    </div>
                    <div class="circle-tile-number text-faded">
                        {{ App\Model\admin\wedstrijden::where('status', 1)->count()}}
                        <span id="sparklineA"></span>
                    </div>
                    <a href="{{ route('wedstrijden.index') }}" class="circle-tile-footer">Meer Info <i class="fa fa-chevron-circle-right"></i></a>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="circle-tile">
                    <div class="circle-tile-heading blue">
                        <i class="fa fa-futbol-o fa-fw fa-3x"></i>
                    </div>
                  <div class="circle-tile-content blue">
                    <div class="circle-tile-description text-faded">
                        Wedstrijden komend
                    </div>
                    <div class="circle-tile-number text-faded">
                        {{ App\Model\admin\wedstrijden::all()->count() - App\Model\admin\wedstrijden::where('status', 1)->count()}}
                        <span id="sparklineA"></span>
                    </div>
                    <a href="{{ route('wedstrijden.index') }}" class="circle-tile-footer">Meer Info <i class="fa fa-chevron-circle-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-offset-2 col-lg-4 col-md-6">
                <div class="circle-tile">
                    <div class="circle-tile-heading orange">
                        <i class="fa fa-address-card fa-fw fa-3x"></i>
                    </div>
                  <div class="circle-tile-content orange">
                    <div class="circle-tile-description text-faded">
                        Users
                    </div>
                    <div class="circle-tile-number text-faded">
                        {{ App\Model\user\User::all()->count()}}
                        <span id="sparklineA"></span>
                    </div>
                    <a href="{{ route('user.index') }}" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                  </div>
                </div>
              </div>

              <div class="col-lg-4 col-md-6">
                <div class="circle-tile">
                    <div class="circle-tile-heading red">
                        <i class="fa fa-lock fa-fw fa-3x"></i>
                    </div>
                  <div class="circle-tile-content red">
                    <div class="circle-tile-description text-faded">
                        Admin
                    </div>
                    <div class="circle-tile-number text-faded">
                        {{ App\Model\admin\admin::all()->count()}}
                        <span id="sparklineA"></span>
                    </div>
                    <a href="{{ route('admin.index') }}" class="circle-tile-footer">Meer Info <i class="fa fa-chevron-circle-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
          <!-- widget van teams , spelers,  // users // wedstrijden gespeeld en nog moeten spelen // mss unique gebruikers //  -->
        </div>
      <!-- /.box -->
      </div>
    <!-- /.content -->
  </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="bower_components/chartist/dist/chartist.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>

@endsection