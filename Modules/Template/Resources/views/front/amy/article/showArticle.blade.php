  @extends ('template::front.amy.layouts.main')

@section ('content')

@if (session('result'))
 <div class="alert alert-info" role="alert">
   {{ session('result') }}
 </div>
@endif

<h1 class="page-header">
    {{ $article->title }}

    @if (RoleHelper::isAdmin())
    <a class="btn btn-primary btn-sm" href="/dashboard/article/edit/id/{{ $article->id }}">
      <i class="fa fa-pencil" aria-hidden="true"></i>
    </a>

    <a href="/dashboard/article/delete/id/{{ $article->id }}">
      <a class="btn btn-danger btn-sm" href="/dashboard/article/{{ $article->id }}"
          onclick="event.preventDefault();
                   document.getElementById('destroy-form').submit();">
          <i class="fa fa-trash" aria-hidden="true"></i>
      </a>

      <form id="destroy-form" action="/dashboard/article/{{ $article->id }}" method="POST" style="display: none;">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
      </form>
    </a>
    @endif

</h1>

<p><i class="fa fa-bullhorn" aria-hidden="true"></i> Опубликовано: {{ $article->created_at->format('d.m.Y') }}</p>
<p><i class="fa fa-user" aria-hidden="true"></i> Создал: {{ $article->user->name }}</p>

<p>{!! $article->body !!}</p>
@stop
