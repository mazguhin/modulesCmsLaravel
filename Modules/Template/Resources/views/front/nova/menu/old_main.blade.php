<!-- @if (count($menu->menuActivatedItems))
  @foreach ($menu->menuActivatedItems as $item)
    <ul>
      @include ('template::front.amy.menu.partials.main.render')
    </ul>
  @endforeach
@else
  @include ('template::front.amy.menu.partials.main.none')
@endif -->

@if ($menu->activated==1)
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">{{ Settings::get('projectName') }}</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              @foreach ($menu->menuActivatedItems as $item)
                <li>
                    <a href="{{ $item->url }}">{{ $item->title }}</a>
                </li>
              @endforeach
            </ul>

            <ul class="nav navbar-nav navbar-right">
              @if (Auth::guest())
                  <li><a href="{{ url('/login') }}">Войти</a></li>
                  <li><a href="{{ url('/register') }}">Регистрация</a></li>
              @else
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                          {{ Auth::user()->name }} <span class="caret"></span>
                      </a>

                      <ul class="dropdown-menu" role="menu">

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
                                  Выход
                              </a>

                              <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                  {{ csrf_field() }}
                              </form>
                          </li>

                      </ul>
                  </li>
              @endif
            </ul>
        </div>
    </div>
</nav>
@endif
