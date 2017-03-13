@extends ('template::back.amy.layouts.main')

@section ('content')
 <div class="panel panel-default">
   <div class="panel-heading">
     <div class="panel-title">Редактирование меню</div>
   </div>

  @if (session('result'))
   <div class="alert alert-info" role="alert">
     {{ session('result') }}
   </div>
  @endif

  @include ('template::back.amy.menu.errors')

   <div class="panel-body">
     <form role="form" method="POST" action="/dashboard/menu/edit/id/{{ $menu->id }}">
       <div class="form-group">
        <label for="title">Заголовок*</label>
        <input type="text" value="{{ $menu->title }}" class="form-control" id="title" name="title" placeholder="Введите заголовок">
       </div>

       <div class="form-group">
        <label for="description">Описание</label>
        <input type="text" value="{{ $menu->description }}" class="form-control" id="description" name="description" placeholder="Введите описание">
        <p class="help-block">Описание может видеть только администратор</p>
       </div>

       <div class="form-group">
         <label for="activated">Активен*</label>
         <select class="form-control" id="activated" name="activated">
           <option value="1" @if ($menu->activated==1) selected @endif >Да</option>
           <option value="0" @if ($menu->activated==0) selected @endif >Нет</option>
          </select>
       </div>

       <div class="form-group">
         <label for="activated">URL*</label>
         <select class="form-control" id="url" name="url">
           <option value="">Отсутствует</option>
           @foreach ($categories as $category)
            <option value="/category/id/{{ $category->id }}"
              @if ($arrayItemUrl[1]=='category' && $arrayItemUrl[3]==$category->id) selected @endif
              >{{ $category->name }} [Категория]</option>
           @endforeach
           @foreach ($articles as $article)
            <option value="/article/id/{{ $article->id }}"
              @if ($arrayItemUrl[1]=='article' && $arrayItemUrl[3]==$article->id) selected @endif
              >{{ $article->title }} [Статья]</option>
           @endforeach
          </select>
       </div>

       <div class="form-group">
         <label for="access">Доступ*</label>
         <select class="form-control" id="access" name="access">
           @foreach ($roles as $role)
           <option value="{{ $role->id }}"
             @if ($role->id==$menu->access->id) selected @endif
           >{{ $role->title }}</option>
           @endforeach
          </select>
       </div>

       <div class="form-group" id="fa-select">
         <label for="faselect">Иконка</label>
         @includeIf('template::back.amy.menu.fa-select-edit')
       </div>

       {{ csrf_field() }}
       <button type="submit" class="btn btn-success">Применить</button>
      </form>
   </div>
 </div>
@stop
