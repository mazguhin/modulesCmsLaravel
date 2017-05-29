@extends ('template::front.nova.layouts.main')
@section ('content')
  <h1 class="page-header">Редактировать новость</h1>

   @if (session('result'))
    <div class="alert alert-info" role="alert">
      {{ session('result') }}
    </div>
    @endif

    @include ('template::front.nova.club.errors')

    <form role="form" method="POST" action="/club/id/{{$id_club}}/news/edit/{{$article->id}}">
      <div class="form-group">
       <label for="title">Заголовок*</label>
       <input type="text" value="{{ $article->title }}" class="form-control" id="title" name="title" placeholder="Введите заголовок">
      </div>

      <div class="form-group">
       <label for="description">Описание</label>
       <input type="text" value="{{ $article->description }}" class="form-control" id="description" name="description" placeholder="Введите описание">
       <p class="help-block">Описание может видеть только администратор</p>
      </div>

      <div class="form-group">
        <textarea id="editor" name="editor">{{ $article->body }}</textarea>
      </div>

      {{ csrf_field() }}
      <button type="submit" class="btn btn-success">Применить</button>
     </form>


  <script src="/plugins/ckeditor/ckeditor.js"></script>
  <script type="text/javascript">
     CKEDITOR.replace('editor');
   </script>
 @stop
