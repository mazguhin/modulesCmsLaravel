@extends ('template::front.amy.layouts.main')

@section ('content')

  <div class="panel panel-default">
    <div class="panel-heading">Профиль</div>
    <div class="panel-body text-center">
      <p><b>Имя:</b> {{$user->name}}</p>
      <p><b>Почта:</b> {{$user->email}}</p>
      <p><b>Дата регистрации:</b> {{$user->created_at->format('d/m/Y h:m:s')}}</p>
      <p><b>Кол-во статей:</b> {{count($user->articles)}}</p>
      <p><b>Кол-во категорий:</b> {{count($user->categories)}}</p>
    </div>
  </div>

@stop
