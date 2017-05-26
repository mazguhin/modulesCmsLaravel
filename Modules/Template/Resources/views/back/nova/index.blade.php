@extends ('template::back.nova.layouts.main')

@section ('content')

<div class="row top_tiles">
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-file-text"></i></div>
      <div class="count">{{ $countArticles }}</div>
      <h3>Статьи</h3>
      <p>На данный момент в базе</p>
    </div>
  </div>
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-child"></i></div>
      <div class="count">{{ $countUsers }}</div>
      <h3>Аккаунтов</h3>
      <p>Зарегистрировано на сайте</p>
    </div>
  </div>
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-comments-o"></i></div>
      <div class="count">{{ $countAnswers }}</div>
      <h3>Ответов</h3>
      <p>Дано на вопросы пользователей</p>
    </div>
  </div>
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-users"></i></div>
      <div class="count">{{ $countClubs }}</div>
      <h3>Клубов</h3>
      <p>Функционирует на сайте</p>
    </div>
  </div>
</div>



<div class="row">

  <div class="col-md-4">
    <div class="x_panel">
      <div class="x_title">
        <h2>Последние пользователи</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        @foreach ($users as $user)
          <article class="media event">
            <a class="pull-left date">
              <p class="month">{{ $user->created_at->format('M') }}</p>
              <p class="day">{{ $user->created_at->day }}</p>
            </a>
            <div class="media-body">
              <a class="title" href="/dashboard/user/edit/id/{{ $user->id }}">{{ $user->name }}</a>
              <p>{{ $user->email }}</p>
              <p>{{ $user->role->title }}</p>
            </div>
          </article>
        @endforeach
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="x_panel">
      <div class="x_title">
        <h2>Последние статьи</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        @foreach ($articles as $article)
          <article class="media event">
            <a class="pull-left date">
              <p class="month">{{ $article->created_at->format('M') }}</p>
              <p class="day">{{ $article->created_at->day }}</p>
            </a>
            <div class="media-body">

              <?php $type = (explode("-",$article->category->slug)) ?>
              @if (count($type)==3 && $type[0]=='clubcode' && ($type[2]=='info' || $type[2]=='news'))
                <a class="title" href="/club/id/{{$type[1]}}/{{$type[2]}}/id/{{$article->id}}">
                  {{ $article->title }}
                </a>
              @else
                <a class="title" href="/article/id/{{ $article->id }}">
                  {{ $article->title }}
                </a>
              @endif

              <p>{{ $article->user->name }}</p>
            </div>
          </article>
        @endforeach
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="x_panel">
      <div class="x_title">
        <h2>Последние категории</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        @foreach ($categories as $category)
          <article class="media event">
            <a class="pull-left date">
              <p class="month">{{ $category->created_at->format('M') }}</p>
              <p class="day">{{ $category->created_at->day }}</p>
            </a>
            <div class="media-body">
              <a class="title" href="/category/id/{{ $category->id }}">{{ $category->name }}</a>
              <p>{{ $category->user->name }}</p>
            </div>
          </article>
        @endforeach
      </div>
    </div>
  </div>

</div>
@stop
