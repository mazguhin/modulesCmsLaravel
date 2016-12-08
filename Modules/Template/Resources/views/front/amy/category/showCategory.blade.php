@extends ('template::front.amy.layouts.main')

@section ('content')
@if (session('result'))
 <div class="alert alert-info" role="alert">
   {{ session('result') }}
 </div>
@endif

<h1 class="page-header">
    {{ $category->name }}

    @if (RoleHelper::isAdmin())
    <a class="btn btn-primary btn-sm" href="/dashboard/category/edit/id/{{ $category->id }}">
      <i class="fa fa-pencil" aria-hidden="true"></i>
    </a>

    <a href="/dashboard/category/delete/id/{{ $category->id }}">
      <a class="btn btn-danger btn-sm" href="/dashboard/category/{{ $category->id }}"
          onclick="event.preventDefault();
                   document.getElementById('destroy-form').submit();">
          <i class="fa fa-trash" aria-hidden="true"></i>
      </a>

      <form id="destroy-form" action="/dashboard/category/{{ $category->id }}" method="POST" style="display: none;">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
      </form>
    </a>
    @endif
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
