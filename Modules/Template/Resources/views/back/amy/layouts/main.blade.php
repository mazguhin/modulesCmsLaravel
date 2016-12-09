<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Smans / Панель управления</title>

    <!-- Styles -->
    <link href="{{ elixir('/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/font-awesome.min.css">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

</head>
<body>
  <main class="container">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/dashboard">Smans</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Статьи <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="/dashboard/article/create">Создать</a></li>
                <li><a href="/dashboard/article">Список</a></li>
              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Категории <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="/dashboard/category/create">Создать</a></li>
                <li><a href="/dashboard/category">Список</a></li>
              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Пользователи <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="/dashboard/user/create">Создать</a></li>
                <li><a href="/dashboard/user">Список</a></li>
              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Меню <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <!-- <li><a href="/dashboard/menu/create">Создать</a></li> -->
                <li><a href="/dashboard/menu">Список</a></li>
              </ul>
            </li>

            <li>
              <a href="/dashboard/setting">Настройки</a>
            </li>

          </ul>
          <ul class="nav navbar-nav navbar-right">

          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                  {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <ul class="dropdown-menu" role="menu">
                  <li>
                    <a href="/">Перейти на сайт</a>
                  </li>

                  <li>
                    <a href="/profile">Профиль</a>
                  </li>

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
          </ul>
        </div>
      </div>
    </nav>

    <div class="content">
      @yield('content')
    </div>
  </main>

  <script src="{{ elixir('/js/app.js') }}"></script>
</body>
</html>
