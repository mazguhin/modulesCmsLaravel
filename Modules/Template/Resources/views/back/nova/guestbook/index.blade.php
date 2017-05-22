@extends ('template::back.nova.layouts.main')

@section ('content')

@if (session('result'))
 <div class="alert alert-info" role="alert">
   {{ session('result') }}
 </div>
@endif

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">Неотвеченные вопросы</div>
    </div>

    @include ('template::back.nova.guestbook.errors')

    <div class="panel panel-body">
      @if (count($questions)>0)
        <div class="list-group">
        @foreach ($questions as $question)
          <div href="#" class="list-group-item">
            <h4 class="list-group-item-heading">{{ $question->user->name }}
              <small>({{ $question->created_at->diffForHumans() }})
                <a class="btn btn-danger btn-sm" href="/dashboard/guestbook/{{ $question->id }}"
                    onclick="event.preventDefault();
                             document.getElementById('destroy-form').submit();">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </a>

                <form id="destroy-form" action="/dashboard/guestbook/{{ $question->id }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                </form>
              </small>
            </h4>
            <p class="list-group-item-text">{{ $question->body }}</p>
            <br>
            <a type="button" class="btn btn-default" href="/dashboard/guestbook/{{$question->id}}">Ответить</a>
          </div>
          @endforeach
        </div>
        {{ $questions->links() }}
      @else
        Вопросы отсутствуют
      @endif
    </div>
@stop
