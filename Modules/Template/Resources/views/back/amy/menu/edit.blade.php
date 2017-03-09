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

       <!-- TODO: disabled у роли не отдает значение в контроллер на валидацию -->
       <div class="form-group">
        <label for="role">Роль*</label>
        <input type="text" value="{{ $menu->role }}" class="form-control" id="role" name="role" placeholder="Введите роль"
        @if ($menu->role=='main')

        @endif
        >
        <p class="help-block">Если вам неизвестно назначение данного поля, то не изменяйте его</p>
       </div>

       <div class="form-group">
         <label for="activated">Активен*</label>
         <select class="form-control" id="activated" name="activated">
           <option value="1" @if ($menu->activated==1) selected @endif >Да</option>
           <option value="0" @if ($menu->activated==0) selected @endif >Нет</option>
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



       {{ csrf_field() }}
       <button type="submit" class="btn btn-success">Применить</button>
      </form>
   </div>
 </div>
@stop
