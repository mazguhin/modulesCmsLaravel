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
              <img src="{{ Auth::user()->getPhoto() }}" alt="">{{ Auth::user()->name }}
            @else
              <img src="/images/user.png" alt="">Гость
            @endif
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            @if (Auth::guest())
            <li><a href="{{ url('/login#signin') }}">Войти</a></li>
            <li><a href="{{ url('/login#signup') }}">Регистрация</a></li>
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

        <!-- alerts -->
        @includeIf ('template::front.nova.layouts.partials.alerts')
        <!-- /alerts -->
      </ul>
    </nav>
  </div>
</div>
