@extends ('template::front.nova.layouts.main')

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
<div class="panel panel-default">
  <div class="panel-heading"><a href="/article/id/{{ $article->id }}">{{ $article->title }}</a></div>
  <div class="panel-body">
    <p>{!! str_limit($article->body, $limit = 800, $end = '...') !!}</p>
    <br>
    <div class="clearfix"></div>
    <p><a class="btn btn-primary btn-sm" href="/article/id/{{ $article->id }}">Читать далее...</a></p>
    <hr>
    <p class="text">
      <img src="{{ $article->user->getPhoto() }}" class="avatar" alt="Avatar">
      &nbsp;
      <b>{{ $article->user->name }}</b>
      <br> &nbsp;
      {{ $article->created_at->diffForHumans() }}
    </p>
  </div>
</div>
@endforeach
{{ $articles->links() }}
@stop
