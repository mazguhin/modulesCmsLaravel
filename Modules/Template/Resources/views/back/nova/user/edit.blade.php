@extends ('template::back.nova.layouts.main')

@section ('content')

@if (session('result'))
<div class="alert alert-info" role="alert">
  {{ session('result') }}

  @if (session('user_id'))
  <div class="btn-group">
    <a href="/user/{{ session('user_id') }}" type="button" class="btn btn-default">Просмотр</a>
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="caret"></span>
      <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu">
      <li><a href="/user/id/{{ session('user_id') }}" target="_blank">В новом окне</a></li>
    </ul>
  </div>
  @endif

</div>
@endif

@include ('template::back.nova.user.errors')

 <div class="panel panel-default">
   <div class="panel-heading">
     <div class="panel-title">Редактирование пользователя</div>
   </div>

  <ol class="breadcrumb">
    <li><a href="/dashboard/user">Пользователи</a></li>
    <li class="active">Редактирование пользователя</li>
  </ol>

   <div class="panel-body">
     <form role="form" method="POST" action="/dashboard/user/edit/id/{{ $user->id }}">
       <div class="form-group">
        <label for="name">Имя*</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" placeholder="Введите имя" required>
       </div>

       <div class="form-group">
        <label for="email">E-mail*</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="Введите e-mail">
       </div>

       <div class="form-group">
         <label for="role">Доступ*</label>
         <select class="form-control" id="role" name="role">
           @foreach ($roles as $role)
           <option value="{{ $role->id }}"
             @if ($role->id==$user->role->id) selected @endif
           >{{ $role->title }}</option>
           @endforeach
          </select>
       </div>

       {{ csrf_field() }}
       <button type="submit" class="btn btn-success">Применить</button>
      </form>


   </div>
 </div>

 <div class="panel panel-default">
   <div class="panel-heading"><div class="panel-title">Изменение пароля пользователя</div></div>
   <div class="panel-body">
     <form action="/dashboard/user/password/id/{{ $user->id }}" method="post">
       {{ csrf_field() }}

       <div class="form-group">
         <label for="password">Новый пароль</label>
         <input type="password" class="form-control" name="password" value="" required>
       </div>

       <div class="form-group">
         <label for="password_confirmation">Подтвердите новый пароль</label>
         <input type="password" class="form-control" name="password_confirmation" value="" required>
       </div>

       <button type="submit" class="btn btn-success">Изменить пароль</button>
     </form>
   </div>
 </div>
@stop
