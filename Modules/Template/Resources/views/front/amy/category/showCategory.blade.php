@extends ('template::front.amy.layouts.main')

@section ('content')
@if (session('result'))
 <div class="alert alert-info" role="alert">
   {{ session('result') }}
 </div>
@endif

<h1 class="page-header">
    {{ $category->name }}
</h1>
@foreach ($articles as $article)
<h2>
    <a href="/article/{{ $article->slug }}">{{ $article->title }}</a>
</h2>
<p><i class="fa fa-bullhorn" aria-hidden="true"></i> Опубликовано {{ $article->created_at->format('d.m.Y') }}</p>
<p>{!! $article->body !!}</p>
<a class="btn btn-primary" href="/article/{{ $article->slug }}">Читать далее...</a>
<hr>
@endforeach
{{ $articles->links() }}
@stop
