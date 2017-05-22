@extends ('template::back.nova.layouts.main')
@section ('content')

@includeIf('template::back.nova.layouts.sections.search')

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">Все пользователи
          <!-- CREATE -->
          <a href="/dashboard/user/create/">
            <button type="button" class="btn btn-primary btn-sm">
              <i class="fa fa-plus" aria-hidden="true"></i>
            </button>
          </a>
        </div>
    </div>

    @if (session('result'))
     <div class="alert alert-info" role="alert">
       {{ session('result') }}
     </div>
    @endif

    @if (count($users) > 0)
    <table class="table table-striped">

        <thead>
            <th>Имя</th>
            <th>E-mail</th>
            <th>Права</th>
            <th>Дата обновления</th>
            <th></th>
        </thead>

        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->title }}</td>
                <td>{{ $user->updated_at->format('d/m/Y H:i:s') }}</td>
                <td>
                  <p>
                  <!-- BAN / UNBAN -->
                  @if ($user->role->name=="banned")
                    <a class="btn btn-default btn-sm" href="/dashboard/user/ban/id/{{ $user->id }}"
                        onclick="event.preventDefault();
                                 document.getElementById('unban-form{{ $user->id }}').submit();">
                        <i class="fa fa-ban" aria-hidden="true"></i>
                    </a>
                  @else


                    <!-- EDIT -->
                    <a href="/dashboard/user/edit/id/{{ $user->id }}">
                      <button type="button" class="btn btn-primary btn-sm">
                          <i class="fa fa-pencil" aria-hidden="true"></i>
                      </button>
                    </a>


                    <a class="btn btn-warning btn-sm" href="/dashboard/user/ban/id/{{ $user->id }}"
                        onclick="event.preventDefault();
                                 document.getElementById('ban-form{{ $user->id }}').submit();">
                        <i class="fa fa-ban" aria-hidden="true"></i>
                    </a>


                  @endif
                  
                      <form id="ban-form{{ $user->id }}" action="/dashboard/user/ban/id/{{ $user->id }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>

                      <form id="unban-form{{ $user->id }}" action="/dashboard/user/unban/id/{{ $user->id }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                  </p>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }} @endif
</div>
@stop

@section('localjs')
$(function() {

  // инициализация заголовков таблицы
  $('#searchTableHead').html('\
    <th>Имя</th>\
    <th>Email</th>\
  ');

  // нажатие кнопки Поиск
  $('#searchBtn').click(function() {
        $('#searchTableBody').html('');
        $.ajax({
        dataType: "json",
        url: '/dashboard/user/search',
        data: {keyword: $('#searchInput').val()},
        success: function (result) {
          if (result.length>0) {
            $.each(result, function(index,value) {
              $('#searchTableBody').append('\
              <tr>\
                <td><a href="/dashboard/user/edit/id/'+value['id']+'">'+value['name']+'</a></td>\
                <td>'+value['email']+'</td>\
              </tr>\
              ');
            });
          } else {
            $('#searchTableBody').append('\
            <tr>\
              <td>Упс!</td>\
              <td>Поиск не дал результатов. Попробуйте другой запрос.</td>\
            </tr>\
            ');
          }
        },
    });

    $('#searchTable').show();
    $('#searchHr').show();
  });

  // нажатие кнопки Сбросить
  $('#cancelBtn').click(function() {
    $('#searchInput').val('');
    $('#searchTableBody').html('');
    $('#searchTable').hide();
    $('#searchHr').hide();
  });

});
@stop
