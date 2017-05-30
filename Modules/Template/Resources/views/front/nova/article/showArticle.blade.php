  @extends ('template::front.nova.layouts.main')

@section ('content')

@if (session('result'))
 <div class="alert alert-info" role="alert">
   {{ session('result') }}
 </div>
@endif

<div class="panel panel-default">
  <div class="panel-heading"><a href="/article/{{ $article->slug }}"><h2>{{ $article->title }}</h2></a></div>
  <div class="panel-body">
    <p>{!! $article->body !!}</p>
    <hr>
    <p class="text">
      <a href="/profile/{{$article->user->id}}">
        <img src="{{ $article->user->getPhoto() }}" class="avatar" alt="Avatar">
        &nbsp;
        <b>{{ $article->user->name }}</b>
      </a>
      <br> &nbsp;
      {{ $article->created_at->diffForHumans() }}
    </p>
    <p>
      @if (RoleHelper::isAdmin())
      <a class="btn btn-primary btn-sm" href="/dashboard/article/edit/id/{{ $article->id }}">
        <i class="fa fa-pencil" aria-hidden="true"></i> Редактировать
      </a>

      <a href="/dashboard/article/delete/id/{{ $article->id }}">
        <a class="btn btn-danger btn-sm" href="/dashboard/article/{{ $article->id }}"
            onclick="event.preventDefault();
                     document.getElementById('destroy-form').submit();">
            <i class="fa fa-trash" aria-hidden="true"></i> Удалить
        </a>

        <form id="destroy-form" action="/dashboard/article/{{ $article->id }}" method="POST" style="display: none;">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
        </form>
      </a>
      @endif
    </p>
  </div>
</div>
@stop
