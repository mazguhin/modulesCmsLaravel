@extends ('template::back.amy.layouts.main')

@section ('content')
 <div class="panel panel-default">
   <div class="panel-heading">
     <div class="panel-title">Создание пункта меню</div>
   </div>

  @if (session('result'))
   <div class="alert alert-info" role="alert">
     {{ session('result') }}
   </div>
  @endif

  @include ('template::back.amy.menu.item.errors')
   <div class="panel-body">
     <form role="form" method="POST" action="/dashboard/menu/item/create/{{ $id_menu }}">
       <div class="form-group">
        <label for="title">Заголовок*</label>
        <input type="text" value="{{old('title')}}" class="form-control" id="title" name="title" placeholder="Введите заголовок">
       </div>

       <div class="form-group">
        <label for="description">Описание</label>
        <input type="text" value="{{old('description')}}" class="form-control" id="description" name="description" placeholder="Введите описание">
        <p class="help-block">Описание может видеть только администратор</p>
       </div>

       <div class="form-group">
         <label for="activated">URL*</label>
         <select class="form-control" id="url" name="url">
           @foreach ($categories as $category)
            <option value="/category/id/{{ $category->id }}">{{ $category->name }} [Категория]</option>
           @endforeach
           @foreach ($articles as $article)
            <option value="/article/id/{{ $article->id }}">{{ $article->title }} [Статья]</option>
           @endforeach
          </select>
       </div>

       <div class="form-group">
         <label for="activated">Активен*</label>
         <select class="form-control" id="activated" name="activated">
           <option value="1">Да</option>
           <option value="0">Нет</option>
          </select>
       </div>

       <div class="form-group">
         <label for="target">Поведение*</label>
         <select class="form-control" id="target" name="target">
           <option value="_self">В активном окне</option>
           <option value="_blank">В новом окне</option>
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

       {{ csrf_field() }}
       <button type="submit" class="btn btn-success">Применить</button>
      </form>
   </div>
 </div>
@stop
