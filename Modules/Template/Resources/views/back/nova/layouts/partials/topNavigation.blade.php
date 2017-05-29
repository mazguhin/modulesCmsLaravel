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
                  <a href="{{ url('/') }}">
                    <i class="fa fa-home pull-right"></i>  Перейти на сайт
                  </a>
              </li>
              @endif

              <!-- Profile -->
              <li>
                  <a href="{{ url('/profile') }}">
                    <i class="fa fa-qq pull-right"></i>  Профиль
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

        @if (RoleHelper::isAdminOrModer())
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <span class="fa fa-folder-o fa-lg"></span>
            <span class="fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a href="/laravel-filemanager?type=Images"><i class="fa fa-file-image-o fa-lg pull-right"></i> Изображения</a></li>
            <li><a href="/laravel-filemanager?type=Files"><i class="fa fa-file-o fa-lg pull-right"></i> Файлы</a></li>
          </ul>
        </li>
        @endif

        <!-- alerts -->
        @includeIf ('template::back.nova.layouts.partials.alerts')
        <!-- /alerts -->
      </ul>
    </nav>
  </div>
</div>
