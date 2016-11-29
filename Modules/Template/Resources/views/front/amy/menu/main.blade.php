<!-- @if (count($menu->menuActivatedItems))
  @foreach ($menu->menuActivatedItems as $item)
    <ul>
      @include ('template::front.amy.menu.partials.main.render')
    </ul>
  @endforeach
@else
  @include ('template::front.amy.menu.partials.main.none')
@endif -->

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Amy</a>
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
              @if (Auth::check())
                <li><a href="/logout">Выйти</a></li>
              @else
                <li><a href="/login">Вход</a></li>
                <li><a href="/register">Регистрация</a></li>
              @endif
            </ul>
        </div>
    </div>
</nav>
