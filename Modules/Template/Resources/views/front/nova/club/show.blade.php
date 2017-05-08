@extends ('template::front.nova.layouts.main')

@section ('content')

@includeIf ('template::front.nova.club.header')

<div class="row">
  <div class="col-sm-12">
    <h3>Новости
    @if (RoleHelper::validatePermissionForClub($club->id))
      <a href="/club/id/{{ $club->id }}/news/create">
        <button type="button" class="btn btn-primary btn-sm">
          <i class="fa fa-plus" aria-hidden="true"></i>
        </button>
      </a>
    @endif
    </h3>
    @if (count($articles)>0)
      <p>
        @foreach ($articles as $article)
          <h4>
              <a href="/club/id/{{ $club->id }}/news/id/{{ $article->id }}">{{ $article->title }}</a>
              @if (RoleHelper::validatePermissionForClub($club->id))

                <a href="/club/id/{{ $club->id }}/news/edit/{{$article->id}}">
                  <button type="button" class="btn btn-primary btn-sm">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                  </button>
                </a>

                  <a class="btn btn-danger btn-sm" href="/club/id/{{ $club->id }}/news/delete/{{ $article->id }}"
                      onclick="event.preventDefault();
                               document.getElementById('destroy-form{{$article->id}}').submit();">
                      <i class="fa fa-trash" aria-hidden="true"></i>
                  </a>

                  <form id="destroy-form{{$article->id}}" action="/club/id/{{ $club->id }}/news/delete/{{ $article->id }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                  </form>

              @endif
          </h4>
          <p><i class="fa fa-bullhorn" aria-hidden="true"></i> Опубликовано {{ $article->created_at->format('d.m.Y') }}</p>
          <p>{!! $article->body !!}</p>
          <a class="btn btn-primary" href="/club/id/{{$club->id}}/news/id/{{$article->id}}">Читать далее...</a>
          <hr>
        @endforeach
        {{ $articles->links() }}
      </p>
    @else
      <p>Новости отсутствуют</p>
    @endif
  </div>
</div>
@stop
