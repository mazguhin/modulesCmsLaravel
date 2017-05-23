@extends ('template::back.nova.layouts.main')

@section ('content')

@if (session('result'))
<div class="alert alert-info" role="alert">
  {{ session('result') }}

  @if (session('slug'))
  <div class="btn-group">
    <a href="/article/{{ session('slug') }}" type="button" class="btn btn-default">Просмотр</a>
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="caret"></span>
      <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu">
      <li><a href="/article/{{ session('slug') }}" target="_blank">В новом окне</a></li>
    </ul>
  </div>
  @endif
  
</div>
@endif

 <div class="panel panel-default">
   <div class="panel-heading">
     <div class="panel-title">Создать новую статью</div>
   </div>

  @include ('template::back.nova.article.errors')

  <ol class="breadcrumb">
    <li><a href="/dashboard/article">Статьи</a></li>
    <li class="active">Создание статьи</li>
  </ol>

   <div class="panel-body">
     <form role="form" method="POST" action="/dashboard/article/create">
       <div class="form-group">
        <label for="title">Заголовок*</label>
        <input type="text" class="form-control" id="title" value="{{ old('title') }}" name="title" placeholder="Введите заголовок" required>
       </div>

       <div class="form-group">
        <label for="description">Описание</label>
        <input type="text" class="form-control" id="description" value="{{ old('description') }}" name="description" placeholder="Введите описание">
        <p class="help-block">Описание может видеть только администратор</p>
       </div>

       <div class="form-group">
        <label for="slug">URL</label>
        <input type="text" class="form-control" id="slug" value="{{ old('slug') }}" name="slug" placeholder="Введите URL">
        <p class="help-block">Если вы не знаете предназначение данного поля, то оставьте его неизменным</p>
       </div>

       <div class="form-group">
         <label for="category">Категория*</label>
         <select class="form-control" id="category" name="category">
            @foreach ($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
       </div>

       <div class="form-group">
         <label for="role">Доступ*</label>
         <select class="form-control" id="role" name="role">
           @foreach ($roles as $role)
             <option value="{{ $role->id }}">{{ $role->title }}</option>
           @endforeach
          </select>
       </div>

       <div class="form-group">
         <textarea id="editor" name="editor">{{ old('editor') }}</textarea>
       </div>

       {{ csrf_field() }}
       <button type="submit" class="btn btn-success">Создать</button>
      </form>
   </div>
 </div>


 <script src="/plugins/ckeditor/ckeditor.js"></script>
 <script type="text/javascript">
    CKEDITOR.replace('editor');
  </script>
@stop
