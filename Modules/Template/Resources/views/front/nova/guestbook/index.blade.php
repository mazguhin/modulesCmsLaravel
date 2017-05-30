  @extends ('template::front.nova.layouts.main')

@section ('content')

@if (session('result'))
 <div class="alert alert-info" role="alert">
   {{ session('result') }}
 </div>
@endif

<h1 class="page-header">Вопросы администрации</h1>

@if (Auth::check())
  <form action="/guestbook" method="post">
    {{ csrf_field() }}
    <div class="form-group">
   <label for="body">Текст сообщения</label>
   <textarea name="body" rows="4" cols="80" class="form-control" required="" placeholder="Введите текст"></textarea>
 </div>
 <button type="submit" class="btn btn-default">Отправить</button>
  </form>

  <hr>
@endif

@foreach ($answers as $answer)
  <div class="list-group">
  @if (Auth::check() && $answer->question->user->id==Auth::user()->id)
  <div href="#" class="list-group-item active">
    <h4 class="list-group-item-heading">Ваш вопрос
  @else
  <div href="#" class="list-group-item">
    <h4 class="list-group-item-heading">Вопрос от <a href="/profile/{{ $answer->question->user->id }}">{{ $answer->question->user->name }}</a>
  @endif
    <small>({{ $answer->question->created_at->diffForHumans() }})
      @if (RoleHelper::isAdmin())
      <a class="btn btn-danger btn-sm" href="/dashboard/guestbook/{{ $answer->question->id }}"
          onclick="event.preventDefault();
                   document.getElementById('destroy-form').submit();">
          <i class="fa fa-trash" aria-hidden="true"></i>
      </a>

      <form id="destroy-form" action="/dashboard/guestbook/{{ $answer->question->id }}" method="POST" style="display: none;">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
      </form>
      @endif
    </small></h4>
    <p class="list-group-item-text">{{ $answer->question->body }}</p>
  </div>
  <div href="#" class="list-group-item">
    <h4 class="list-group-item-heading">Ответ от <a href="/profile/{{ $answer->user->id }}">{{ $answer->user->name }}</a>
    <small>({{ $answer->updated_at->diffForHumans() }})
      @if (RoleHelper::isAdmin())
      <a class="btn btn-primary btn-sm" href="/dashboard/guestbook/edit/{{ $answer->question->id }}">
        <i class="fa fa-pencil" aria-hidden="true"></i>
      </a>
      @endif
    </small></h4>
    <p class="list-group-item-text">{{ $answer->body }}</p>
  </div>
  </div>
  <hr>
@endforeach

{{ $answers->links() }}
@stop
