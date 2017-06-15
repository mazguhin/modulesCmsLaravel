@extends ('template::back.nova.layouts.main')

@section ('content')

@if (session('result'))
 <div class="alert alert-info" role="alert">
   {{ session('result') }}

   @if (session('blog_id'))
    <div class="btn-group">
      <a href="/blog/id/{{ session('blog_id') }}" type="button" class="btn btn-default">Просмотр</a>
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
      </button>
      <ul class="dropdown-menu">
        <li><a href="/blog/id/{{ session('blog_id') }}" target="_blank">В новом окне</a></li>
      </ul>
    </div>
   @endif

 </div>
@endif

@include ('template::back.nova.blog.errors')

 <div class="panel panel-default">
   <div class="panel-heading">
     <div class="panel-title">Создать новый блог</div>
   </div>


  <ol class="breadcrumb">
    <li><a href="/dashboard/blog">Блоги</a></li>
    <li class="active">Создание блога</li>
  </ol>

   <div class="panel-body">
     <form role="form" method="POST" action="/dashboard/blog/create">
       <div class="form-group">
        <label for="name">Наименование*</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Введите название" required>
        <p class="help-block">Название блога может изменяться модератором</p>
       </div>

       <div class="form-group">
        <label for="description">Описание</label>
        <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}" placeholder="Введите описание">
        <p class="help-block">Доступно всем пользователям</p>
       </div>

       <div class="form-group">
        <label for="slug">Адрес*</label>
        <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}" placeholder="Введите адрес" required>
        <p class="help-block">Только латиницей. Пример: ivanov</p>
       </div>

       <div class="form-group" id="fa-select">
         <label for="moder">Модератор*</label>
         <select class="form-control selectpicker" id="moder" name="moder" title="Назначить модераторов клуба">
            @foreach ($moders as $moder)
              <option value="{{ $moder->id }}">{{ $moder->name }}</option>
            @endforeach
          </select>
       </div>

       {{ csrf_field() }}
       <button type="submit" class="btn btn-success">Создать</button>
      </form>
   </div>
 </div>
@stop
