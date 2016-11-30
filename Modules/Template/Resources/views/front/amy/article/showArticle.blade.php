@extends ('template::front.amy.layouts.main')

@section ('content')
<h1 class="page-header">
    {{ $article->title }}
</h1>
@if (RoleHelper::isAdmin())
<p>
  <a class="btn btn-default" href="/dashboard/article/edit/id/{{ $article->id }}">Редактировать</a>
  <a href="/dashboard/article/delete/id/{{ $article->id }}">
    <a class="btn btn-danger" href="/dashboard/article/{{ $article->id }}"
        onclick="event.preventDefault();
                 document.getElementById('destroy-form').submit();">
        Удалить
    </a>

    <form id="destroy-form" action="/dashboard/article/{{ $article->id }}" method="POST" style="display: none;">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
    </form>
  </a>
</p>
<hr>
@endif
<p><i class="fa fa-bullhorn" aria-hidden="true"></i> Опубликовано: {{ $article->created_at->format('d.m.Y') }}</p>
<p><i class="fa fa-user" aria-hidden="true"></i> Создал: {{ $article->user->name }}</p>

<p>{!! $article->body !!}</p>
@stop
