@extends ('blog::standard.layouts.main')

@section ('content')

    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
          <a class="blog-nav-item active" href="#">Главная</a>
          <a class="blog-nav-item" href="#">New features</a>
          <a class="blog-nav-item" href="#">Press</a>
          <a class="blog-nav-item" href="#">New hires</a>
          <a class="blog-nav-item" href="#">About</a>
        </nav>
      </div>
    </div>

    <div class="container">

      <div class="blog-header">
        <h1 class="blog-title">{{ $blog->title }}</h1>
        <p class="lead blog-description">{{ $blog->description }}</p>
      </div>

      <div class="row">

        <div class="col-sm-8 blog-main">

          @foreach ($articles as $article)
          <div class="blog-post">
            <h2 class="blog-post-title">{{ $article->title }}</h2>
            <p class="blog-post-meta">{{ $article->created_at->format('d/m/Y H:m:s') }} <a href="/profile/{{ $article->user->id }}">{{ $article->user->name }}</a></p>

            <p>{!! $article->body !!}</p>
          </div><!-- /.blog-post -->
          @endforeach


        </div><!-- /.blog-main -->

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
          <div class="sidebar-module sidebar-module-inset">
            <h4>Об авторе</h4>
            <p>{{ $blog->about }}</p>
          </div>
          <div class="sidebar-module">
            <h4>Категории</h4>
            <ol class="list-unstyled">
              @foreach ($categories as $category)
              <li><a href="/blog/{{ $blog->slug }}/category/{{ $category->id }}">{{ $category->title }}</a></li>
              @endforeach
            </ol>
          </div>
        </div><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </div><!-- /.container -->

    <div class="blog-footer">
      <p>Подвал</p>
      <p>
        <a href="#">Наверх</a>
      </p>
    </div>

@stop
