@extends ('template::back.nova.layouts.main') @section ('content')

@includeIf('template::back.nova.layouts.sections.search')

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">Все клубы
          <!-- CREATE -->
          <a href="/dashboard/club/create/">
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

    @if (count($clubs) > 0)
    <table class="table table-striped">

        <thead>
            <th>Название</th>
            <th>Тип</th>
            <th>Дата обновления</th>
            <th>Действия</th>
        </thead>

        <tbody>
            @foreach ($clubs as $club)
            <tr>
                <td>{{ $club->name }}</td>
                <td>
                  @if ($club->pay==false) Бесплатный @else Платный @endif
                </td>
                <td>{{ $club->updated_at->format('d/m/Y h:m:s') }}</td>
                <td>

                <p>
                  <a href="/dashboard/club/edit/id/{{ $club->id }}">
                    <button type="button" class="btn btn-primary btn-sm">
                      <i class="fa fa-pencil" aria-hidden="true"></i>
                    </button>
                  </a>

                  <a class="btn btn-danger btn-sm" href="/dashboard/club/{{ $club->id }}"
                      onclick="event.preventDefault();
                               document.getElementById('destroy-form{{ $club->id }}').submit();">
                      <i class="fa fa-trash" aria-hidden="true"></i>
                  </a>

                  <form id="destroy-form{{ $club->id }}" action="/dashboard/club/{{ $club->id }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                  </form>
              </p>
              </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $clubs->links() }}
    @endif
</div>
@stop

@section('localjs')
$(function() {

  // инициализация заголовков таблицы
  $('#searchTableHead').html('\
    <th>Заголовок</th>\
    <th>Описание</th>\
  ');

  // нажатие кнопки Поиск
  $('#searchBtn').click(function() {
        $('#searchTableBody').html('');
        $.ajax({
        dataType: "json",
        url: '/dashboard/club/search',
        data: {keyword: $('#searchInput').val()},
        success: function (result) {
          if (result.length>0) {
            $.each(result, function(index,value) {
              $('#searchTableBody').append('\
              <tr>\
                <td><a href="/club/id/'+value['id']+'">'+value['name']+'</a></td>\
                <td>'+value['description']+'</td>\
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
