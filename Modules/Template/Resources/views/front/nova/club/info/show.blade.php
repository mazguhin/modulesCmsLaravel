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

          <!-- info -->
          <div>
            <h4>{{ $article->title }}</h4>
            <p>{!! $article->body !!}</p>
          </div>

          <hr>
          <p class="text">
            <img src="{{ $article->user->getPhoto() }}" class="avatar" alt="Avatar">
            &nbsp;
            <b>{{ $article->user->name }}</b>
            <br> &nbsp;
            {{ $article->created_at->diffForHumans() }}
          </p>

          @if (RoleHelper::validatePermissionForClub($club->id))
          <a href="/club/id/{{ $club->id }}/info/edit/{{$article->id}}">
            <button type="button" class="btn btn-primary btn-xs">
              <i class="fa fa-pencil" aria-hidden="true"></i> Редактировать
            </button>
          </a>

            <a class="btn btn-danger btn-xs" href="/club/id/{{ $club->id }}/info/delete/{{ $article->id }}"
                onclick="event.preventDefault();
                         document.getElementById('destroy-form{{$article->id}}').submit();">
                <i class="fa fa-trash" aria-hidden="true"></i> Удалить
            </a>

            <form id="destroy-form{{$article->id}}" action="/club/id/{{ $club->id }}/info/delete/{{ $article->id }}" method="POST" style="display: none;">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
            </form>
          @endif
          <!-- end info -->

        </div>

        <!-- start club-detail sidebar -->
        @includeIf ('template::front.nova.club.detail')
        <!-- end club-detail sidebar -->

      </div>
    </div>
  </div>
</div>

@stop
