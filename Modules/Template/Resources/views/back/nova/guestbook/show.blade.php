@extends ('template::back.nova.layouts.main') @section ('content')

@if (session('result'))
 <div class="alert alert-info" role="alert">
   {{ session('result') }}
 </div>
@endif

 <div class="panel panel-default">
   <div class="panel-heading">
     <div class="panel-title">Ответить на вопрос</div>
   </div>

  @include ('template::back.nova.guestbook.errors')
  <ol class="breadcrumb">
    <li><a href="/dashboard/guestbook">Гостевая книга</a></li>
    <li class="active">Ответ на вопрос</li>
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


     <form role="form" method="POST" action="/dashboard/guestbook/{{$question->id}}">
       <div class="form-group">
        <label for="body">Текст ответа</label>
        <textarea type="text" rows="4" cols="80" class="form-control" id="body" value="{{ old('body') }}" name="body" placeholder="Введите ответ" required></textarea>
       </div>

       {{ csrf_field() }}
       <button type="submit" class="btn btn-success">Ответить</button>
      </form>
   </div>
 </div>
@stop
