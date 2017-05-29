@extends ('template::front.nova.layouts.main')

@section ('content')

@if (session('result'))
 <div class="alert alert-info" role="alert">
   {{ session('result') }}
 </div>
@endif

<div class="row">
  <div class="col-md-12">
    <div class="x_panel">

      <div class="x_content">
        <div class="col-md-9 col-sm-9 col-xs-12">
          @includeIf ('template::front.nova.club.header')
          <br />

          <!-- news -->
          <div>
            <h4>Новости</h4>

            @if (count($articles)>0)
            <ul class="messages">
              @foreach ($articles as $article)
              <li>
                <img src="{{ $article->user->getPhoto() }}" class="avatar" alt="Avatar">
                <div class="message_date">
                  <h3 class="date text-info">{{ $club->created_at->day }}</h3>
                  <p class="month">{{ $club->created_at->format('F') }}</p>
                </div>
                <div class="message_wrapper">
                  <a href="/club/id/{{ $club->id }}/news/id/{{ $article->id }}">
                    <h4 class="heading">{{ $article->user->name }}</h4>
                    <blockquote class="message">{{ str_limit($article->title, $limit = 100, $end = '...') }}</blockquote>
                  </a>
                  <br />
                  <p class="url">
                    @if (RoleHelper::validatePermissionForClub($club->id))

                      <a href="/club/id/{{ $club->id }}/news/edit/{{$article->id}}" class="btn btn-primary btn-xs">
                          <i class="fa fa-pencil" aria-hidden="true"></i> Редактировать
                      </a>

                        <a class="btn btn-danger btn-xs" href="/club/id/{{ $club->id }}/news/delete/{{ $article->id }}"
                            onclick="event.preventDefault();
                                     document.getElementById('destroy-form{{$article->id}}').submit();">
                            <i class="fa fa-trash" aria-hidden="true"></i> Удалить
                        </a>

                        <form id="destroy-form{{$article->id}}" action="/club/id/{{ $club->id }}/news/delete/{{ $article->id }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>

                    @endif
                  </p>
                </div>
              </li>
              @endforeach
            </ul>
            @else
              Новости отсутствуют
            @endif

            {{ $articles->links() }}
          </div>
          <!-- end news -->

        </div>

        <!-- start club-detail sidebar -->
        @includeIf ('template::front.nova.club.detail')
        <!-- end club-detail sidebar -->

      </div>
    </div>
  </div>
</div>

@stop
