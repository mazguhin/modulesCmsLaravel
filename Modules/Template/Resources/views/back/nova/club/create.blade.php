@extends ('template::back.nova.layouts.main')

@section ('content')
 <div class="panel panel-default">
   <div class="panel-heading">
     <div class="panel-title">Создать новый клуб</div>
   </div>

  @if (session('result'))
   <div class="alert alert-info" role="alert">
     {{ session('result') }}

     @if (session('club_id'))
      <div class="btn-group">
        <a href="/club/id/{{ session('club_id') }}" type="button" class="btn btn-default">Просмотр</a>
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="caret"></span>
          <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu">
          <li><a href="/club/id/{{ session('club_id') }}" target="_blank">В новом окне</a></li>
        </ul>
      </div>
     @endif

   </div>
  @endif

  @include ('template::back.nova.club.errors')

  <ol class="breadcrumb">
    <li><a href="/dashboard/club">Клубы</a></li>
    <li class="active">Создание клуба</li>
  </ol>

   <div class="panel-body">
     <form role="form" method="POST" action="/dashboard/club/create">
       <div class="form-group">
        <label for="name">Название*</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Введите название" required>
       </div>

       <div class="form-group">
        <label for="description">Описание</label>
        <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}" placeholder="Введите описание">
        <p class="help-block">Описание может видеть только администратор</p>
       </div>

       <div class="form-group">
         <label for="role">Тип*</label>
         <select class="form-control" id="pay" name="pay">
           <option value="0">Бесплатный</option>
           <option value="1">Платный</option>
          </select>
       </div>

       <div class="form-group" id="fa-select">
         <label for="moders">Модераторы</label>
         <select class="form-control selectpicker" id="moders" name="moders[]" title="Назначить модераторов клуба" multiple>
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
