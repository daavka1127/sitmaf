
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" type="image/x-icon" href="{{url('public/images/gsmaf_logo.ico')}}"/>

    <title>Төмөр замын ажлын мэдээлэл</title>

    <link href="{{url('public/css/zam_styles.css')}}" rel="stylesheet">

    <!-- SLIDER CSS -->
		<link rel="stylesheet" href="{{url('public/dist/css/slider-pro.min.css')}}"/>
		<!-- END SLIDER CSS -->

    <!-- Bootstrap -->
    <link href="{{url('public/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{url('public/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{url('public/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{url('public/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="{{url('public/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{url('public/vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{url('public/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{url('public/build/css/custom.min.css')}}" rel="stylesheet">

    <!-- jQuery -->
    <script src="{{url('public/vendors/jquery/dist/jquery.min.js')}}"></script>

    <script src="{{url('public/js/fullscreenTab.js')}}"></script>

    <!--Zagvarlag alert-->
    <link rel="stylesheet" href="{{ asset('public/z-alert/css/alertify.core.css') }}" />
	  <link rel="stylesheet" href="{{ asset('public/z-alert/css/alertify.default.css') }}" />
    <script src="{{ asset('public/z-alert/js/alertify.min.js') }}"></script>
    <!--Zagvarlag alert-->

    <!--row auto merge-->
    <script src="{{ asset('public/js/row-merge/jquery.rowspanizer.js') }}"></script>
    <script src="{{ asset('public/js/row-merge/jquery.rowspanizer.min.js') }}"></script>
    <!--row auto merge-->
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{url('/home')}}" class="site_title"><i class="fa fa-paw"></i> <span>ЗХЖШ</span></a>
            </div>

            <div class="clearfix"></div>
            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{url('public/images/gsmaf_logo.png')}}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Сайн байна уу,</span>
                <h2>{{ Auth::user()->name }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Цэс</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bar-chart"></i>Тайлан график <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/home')}}">Гүйцэтгэлийн график</a></li>
                      {{-- <li><a href="{{url('/report/table')}}">Гүйцэтгэл хүснэгтээр</a></li> --}}
                      <li><a href="{{url('/show/html')}}">Гүйцэтгэл хүснэгтээр</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-plus-square"></i> Өгөгдөл оруулах <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/companies/new')}}">Аж ахуйн нэгж нэмэх</a></li>
                      <li><a href="{{url('/guitsetgel/new')}}">Гүйцэтгэл нэмэх</a></li>
                      {{-- <li><a href="{{url('/hunHuch/new')}}">Хүн, хүч нэмэх</a></li> --}}
                      <li><a href="{{url('/image/new')}}">Зураг оруулах</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-camera"></i>Зураг <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/resizeImage')}}">Зургийн цомог</a></li>
                      {{-- <li><a href="{{url('/admins')}}">Админ засах</a></li> --}}
                    </ul>
                  </li>

                  @if(Auth::user()->heseg_id == 5 )
                    <li><a><i class="fa fa-user"></i>Админ эрх <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{url('/register')}}">Админ нэмэх</a></li>
                        {{-- <li><a href="{{url('/admins')}}">Админ засах</a></li> --}}
                      </ul>
                    </li>
                    <li><a><i class="fa fa-th-list"></i>Ажил table <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{url('/work_type/show')}}">Ажлын төрөл</a></li>
                          <li><a href="{{url('/work/show')}}">Хийх ажилууд</a></li>
                        </ul>
                    </li>
                  @endif

                </ul>
              </div>
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a href="{{url("/changePassword")}}"><i class="fa fa-unlock-alt"></i> Нууц үг солих <span class="fa fa-chevron-down"></span></a></li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" id="fullscreenTab" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('logout') }}" onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{url('public/images/gsmaf_logo.png')}}" alt="">{{ Auth::user()->name }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{url("/changePassword")}}">Нууц үг солих</a></li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Гарах</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          @yield("content")
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Зэвсэгт хүчний программ хангажийн төв. &copy;2020
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    {{-- CHART JS --}}
    <script src="{{url('public/js/chart/jquery.canvasjs.min.js')}}"></script>

    <!-- Bootstrap -->
    <script src="{{url('public/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <!-- DateJS -->
    <script src="{{url('public/vendors/DateJS/build/date.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{url('public/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{url('public/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{url('public/build/js/custom.min.js')}}"></script>

    <!-- SLIDER JS -->
		<script src="{{url("public/dist/js/jquery.sliderPro.min.js")}}"></script>

  </body>
</html>
