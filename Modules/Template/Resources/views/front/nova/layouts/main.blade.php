<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ Settings::get('projectName') }}</title>

    <!-- Bootstrap -->
    <link href="/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/build/css/custom.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <!-- local styles -->
    <style>
      .infopages {
        padding: 10px;
      }

      .infopages:hover {
        background-color: #EDEDED;
      }
    </style>

    <style>
      @yield('localcss')
    </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="/" class="site_title"><i class="fa fa-home"></i> <span>{{ Settings::get('projectName') }}</span></a>
            </div>

            <div class="clearfix"></div>


            <!-- menu profile quick info -->
            <div class="profile">
              @if (Auth::check())
                <div class="profile_pic">
                  <a href="/profile"><img src="/images/user.png" class="img-circle profile_img"></a>
                </div>
                <div class="profile_info">
                  <span>Добро пожаловать,</span>
                  <h2>{{ Auth::user()->name }}</h2>
                </div>
              @else
                <div class="profile_pic">
                  <a href="/login"><img src="/images/user.png" class="img-circle profile_img"></a>
                </div>
                <div class="profile_info">
                  <span>Добро пожаловать,</span>
                  <h2>гость</h2>
                </div>
              @endif
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            @includeIf ('template::front.nova.menu.main', ['menus' => MenuHelper::getAll()])
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav class="" role="navigation">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    @if (Auth::check())
                      <img src="/images/user.png" alt="">{{ Auth::user()->name }}
                    @else
                      <img src="/images/user.png" alt="">Гость
                    @endif
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Войти</a></li>
                    <li><a href="{{ url('/register') }}">Регистрация</a></li>
                    @else
                      <!-- dashboard for admin -->
                      @if (RoleHelper::isAdmin())
                      <li>
                          <a href="{{ url('/dashboard') }}">
                              Панель управления
                          </a>
                      </li>
                      @endif

                      <!-- Profile -->
                      <li>
                          <a href="{{ url('/profile') }}">
                              Профиль
                          </a>
                      </li>

                        <!-- Logout -->
                        <li>
                            <a href="{{ url('/logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out pull-right"></i> Выход
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>

                      @endif
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="/images/user.png" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="/images/user.png" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="/images/user.png" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="/images/user.png" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              @yield('content')
            </div>
          </div>
          <br />
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Footer
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="/vendors/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- bootstrap-progressbar -->
    <script src="/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>


    <!-- Custom Theme Scripts -->
    <script src="/build/js/custom.min.js"></script>
  </body>
</html>
