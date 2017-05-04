@extends ('template::back.amy.layouts.main') @section ('content')

@includeIf('template::back.amy.layouts.sections.search')

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">Все категории
          <!-- CREATE -->
          <a href="/dashboard/category/create/">
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

    @if (count($categories) > 0)
    <table class="table table-striped">

        <thead>
            <th>Название</th>
            <th>Доступ</th>
            <th>Создал</th>
            <th>Дата обновления</th>
            <th>Действия</th>
        </thead>

        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>
                  {{ $category->name }}
                  @if ($category->id==$startPageId)
                  <i class="fa fa-home" aria-hidden="true"></i>
                  @endif
                </td>
                <td>{{ $category->role->title }}</td>
                <td>{{ $category->user->name }}</td>
                <td>{{ $category->updated_at->format('d/m/Y h:m:s') }}</td>
                <td>

                <p>
                  <a href="/dashboard/category/edit/id/{{ $category->id }}">
                    <button type="button" class="btn btn-primary btn-sm">
                      <i class="fa fa-pencil" aria-hidden="true"></i>
                    </button>
                  </a>


                  @if ($category->id!=$startPageId)

                  <!-- setStartPage -->
                  <a href="/dashboard/setting/startpage/{{ $category->id }}">
                    <a class="btn btn-default btn-sm" href="/dashboard/setting/startpage/{{ $category->id }}"
                        onclick="event.preventDefault();
                                 document.getElementById('setStartPage-form{{ $category->id }}').submit();">
                                 <i class="fa fa-home" aria-hidden="true"></i>
                    </a>
                  </a>

                  <a href="/dashboard/category/delete/id/{{ $category->id }}">
                    <a class="btn btn-danger btn-sm" href="/dashboard/category/{{ $category->id }}"
                        onclick="event.preventDefault();
                                 document.getElementById('destroy-form{{ $category->id }}').submit();">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                  </a>

                    <form id="destroy-form{{ $category->id }}" action="/dashboard/category/{{ $category->id }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>

                    <form id="setStartPage-form{{ $category->id }}" action="/dashboard/setting/startpage/{{ $category->id }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        <input type="hidden" name="type" value="category">
                    </form>
                @endif
              </p>
              </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $categories->links() }} @endif
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
        url: '/dashboard/category/search',
        data: {keyword: $('#searchInput').val()},
        success: function (result) {
          if (result.length>0) {
            $.each(result, function(index,value) {
              $('#searchTableBody').append('\
              <tr>\
                <td><a href="/category/id/'+value['id']+'">'+value['name']+'</a></td>\
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
