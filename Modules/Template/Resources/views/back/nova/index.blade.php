@extends ('template::back.nova.layouts.main')

@section ('content')
     <div class="panel panel-default col-sm-12">
       <div class="panel-heading">
         <div class="panel-title">Последние пользователи</div>
       </div>
       <div class="panel-body">
         <table class="table table-striped">
          <thead>
            <th>Имя</th>
            <th>Права</th>
          </thead>
          <tbody>
            @foreach ($users as $user)
              <tr>
                <td><a href="/dashboard/user/edit/id/{{ $user->id }}">{{ $user->name }}</a></td>
                <td>{{ $user->role->title }}</td>
              </tr>
            @endforeach
          </tbody>
         </table>
       </div>
     </div>


     <div class="panel panel-default col-sm-4 col-sm-offset-1">
       <div class="panel-heading">
         <div class="panel-title">Последние статьи</div>
       </div>
       <div class="panel-body">
         <table class="table table-striped">
          <thead>
            <th>Заголовок</th>
          </thead>
          <tbody>
            @foreach ($articles as $article)
              <tr>
                <td><a href="/dashboard/article/edit/id/{{ $article->id }}">{{ $article->title }}</a></td>
              </tr>
            @endforeach
          </tbody>
         </table>
       </div>
     </div>

     <div class="panel panel-default col-sm-4 col-sm-offset-1">
       <div class="panel-heading">
         <div class="panel-title">Последние категории</div>
       </div>
       <div class="panel-body">
         <table class="table table-striped">
          <thead>
            <th>Заголовок</th>
          </thead>
          <tbody>
            @foreach ($categories as $category)
              <tr>
                <td><a href="/dashboard/category/edit/id/{{ $category->id }}">{{ $category->name }}</a></td>
              </tr>
            @endforeach
          </tbody>
         </table>
       </div>
     </div>
@stop
