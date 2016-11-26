@extends ('template::front.amy.layouts.main')

@section ('content')
<h1 class="page-header">
    {{ $article->title }}
</h1>
<p><i class="fa fa-bullhorn" aria-hidden="true"></i> Опубликовано {{ $article->created_at->format('d.m.Y') }}</p>
@if (RoleHelper::isAdmin())
<p>[<a href="/dashboard/article/edit/id/{{ $article->id }}">Редактировать</a>]</p>
@endif
<p>{!! $article->body !!}</p>
@stop
