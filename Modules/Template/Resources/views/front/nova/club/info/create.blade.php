@extends ('template::front.nova.layouts.main')

@section ('content')

  @if (session('result'))
   <div class="alert alert-info" role="alert">
     {{ session('result') }}
   </div>
  @endif

 <h1 class="page-header">Создать новость</h1>

  @include ('template::front.nova.club.errors')

     <form role="form" method="POST" action="/club/id/{{$id_club}}/info/create">
       <div class="form-group">
        <label for="title">Заголовок*</label>
        <input type="text" class="form-control" id="title" value="{{ old('title') }}" name="title" placeholder="Введите заголовок" required>
       </div>

       <div class="form-group">
        <label for="description">Описание</label>
        <input type="text" class="form-control" id="description" value="{{ old('description') }}" name="description" placeholder="Введите описание">
        <p class="help-block">Описание может видеть только администратор/модератор</p>
       </div>

       <div class="form-group">
         <textarea id="editor" name="editor">{{ old('editor') }}</textarea>
       </div>

       {{ csrf_field() }}
       <button type="submit" class="btn btn-success">Создать</button>
    </form>


 <script src="/plugins/ckeditor/ckeditor.js"></script>
 <script type="text/javascript">
    CKEDITOR.replace('editor');
  </script>
@stop
