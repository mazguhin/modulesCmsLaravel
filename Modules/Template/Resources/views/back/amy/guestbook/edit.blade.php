@extends ('template::back.amy.layouts.main')

@section ('content')
 <div class="panel panel-default">
   <div class="panel-heading">
     <div class="panel-title">Ответить на вопрос</div>
   </div>

  @if (session('result'))
   <div class="alert alert-info" role="alert">
     {{ session('result') }}
   </div>
  @endif

  @include ('template::back.amy.guestbook.errors')
  <ol class="breadcrumb">
    <li><a href="/guestbook">Гостевая книга</a></li>
    <li class="active">Редактирование ответа</li>
  </ol>

   <div class="panel-body">
     <div class="list-group">
     <div href="#" class="list-group-item">
       <h4 class="list-group-item-heading">{{ $question->user->name }}
         <small>({{ $question->created_at->diffForHumans() }})</small>
       </h4>
       <p class="list-group-item-text">{{ $question->body }}</p>
     </div>
     </div>


     <form role="form" method="POST" action="/dashboard/guestbook/edit/{{$question->id}}">
       <div class="form-group">
        <label for="body">Текст ответа</label>
        <textarea type="text" rows="4" cols="80" class="form-control" id="body" name="body" placeholder="Введите ответ" required>{{ $question->answer->body }}</textarea>
       </div>

       {{ csrf_field() }}
       <button type="submit" class="btn btn-success">Ответить</button>
      </form>
   </div>
 </div>
@stop
