@extends ('template::back.amy.layouts.main')

@section ('content')
 <div class="panel panel-default">
   <div class="panel-heading">
     <div class="panel-title">Настройки</div>
   </div>

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

  @include ('template::back.amy.article.errors')

   <div class="panel-body">
     <form role="form" method="POST" action="/dashboard/setting">
       <table class="table table-striped">

           <thead>
               <th>Наименование</th>
               <th>Описание</th>
               <th>Значение</th>
           </thead>

           <tbody>
             @foreach ($settings as $setting)
               <tr>
                   <td>{{ $setting->title }}</td>
                   <td>{{ $setting->description }}</td>
                   <td>
                      <input type="text" class="form-control" value="{{ $setting->value }}" name="{{ $setting->name }}" placeholder="Введите значение" required>
                   </td>
               </tr>
              @endforeach
           </tbody>
       </table>

       {{ csrf_field() }}
       <button type="submit" class="btn btn-success">Сохранить</button>
      </form>
   </div>
 </div>
@stop
