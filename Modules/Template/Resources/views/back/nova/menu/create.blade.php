@extends ('template::back.nova.layouts.main')

@section ('content')

@if (session('result'))
<div class="alert alert-info" role="alert">
  {{ session('result') }}
</div>
@endif

@include ('template::back.nova.article.errors')

 <div class="panel panel-default">
   <div class="panel-heading">
     <div class="panel-title">Создать новое меню</div>
   </div>

  <ol class="breadcrumb">
    <li><a href="/dashboard/menu">Меню</a></li>
    <li class="active">Создание меню</li>
  </ol>

   <div class="panel-body">
     <form role="form" method="POST" action="/dashboard/menu/create">
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
         <label for="activated">Активен*</label>
         <select class="form-control" id="activated" name="activated">
           <option value="1">Да</option>
           <option value="0">Нет</option>
          </select>
       </div>

       <div class="form-group">
         <label for="activated">URL*</label>
         <select class="form-control selectpicker" data-live-search="true" id="url" name="url">
           <option value="" selected>Отсутствует</option>
           <optgroup label="Категории">
           @foreach ($categories as $category)
            <option value="/category/id/{{ $category->id }}">{{ $category->name }}</option>
           @endforeach
          </optgroup>
          <optgroup label="Сотрудники">
           <option value="/staff/category">Список категорий</option>
         </optgroup>
         <optgroup label="Гостевая книга">
          <option value="/guestbook">Страница гостевой книги</option>
        </optgroup>
          <optgroup label="Клубы">
           @foreach ($clubs as $club)
            <option value="/club/id/{{ $club->id }}">{{ $club->name }}</option>
           @endforeach
          </optgroup>
          <optgroup label="Статьи">
           @foreach ($articles as $article)
            <option value="/article/id/{{ $article->id }}">{{ $article->title }}</option>
           @endforeach
           </optgroup>
          </select>
       </div>

       <div class="form-group">
         <label for="access">Доступ*</label>
         <select class="form-control" id="access" name="access">
           @foreach ($roles as $role)
           <option value="{{ $role->id }}">
            {{ $role->title }}
           </option>
           @endforeach
          </select>
       </div>

       <div class="form-group" id="fa-select">
         <label for="faselect">Иконка</label>
         @includeIf('template::back.nova.menu.fa-select-create')
       </div>

       {{ csrf_field() }}
       <button type="submit" class="btn btn-success">Создать</button>
      </form>
   </div>
 </div>
@stop
