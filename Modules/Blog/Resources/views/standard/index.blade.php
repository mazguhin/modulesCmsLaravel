@extends ('blog::standard.layouts.main')

@section ('content')

        <div class="col-sm-8 blog-main">
          @foreach ($articles as $article)
          <div class="blog-post">
            <h2 class="blog-post-title">{{ $article->title }}</h2>
            <p class="blog-post-meta">
              {{ $article->created_at->format('d/m/Y H:m:s') }} <a href="/profile/{{ $article->user->id }}">{{ $article->user->name }}</a>
              <br>
              Категория: <a href="/blog/id/{{ $blog->id }}/category/{{ $article->category->id }}">{{ $article->category->title }}</a>
            </p>
            <p>{!! str_limit($article->body, $limit = 800, $end = '...') !!}</p>
            <p><a href="/blog/id/{{ $blog->id }}/article/{{ $article->id }}" class="btn btn-default">Читать далее...</a></p>
          </div>
          <hr>
          @endforeach
        </div>

@stop
