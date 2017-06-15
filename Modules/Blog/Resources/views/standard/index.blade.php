@extends ('blog::standard.layouts.main')

@section ('content')

        <div class="col-sm-8 blog-main">
          @foreach ($articles as $article)
          <div class="blog-post">
            <h2 class="blog-post-title">{{ $article->title }}</h2>
            <p class="blog-post-meta">{{ $article->created_at->format('d/m/Y H:m:s') }} <a href="/profile/{{ $article->user->id }}">{{ $article->user->name }}</a></p>

            <p>{!! $article->body !!}</p>
          </div>
          <hr>
          @endforeach
        </div>

@stop
