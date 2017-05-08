@extends ('template::back.amy.layouts.main')

@section ('content')

@includeIf('template::back.amy.layouts.sections.search')

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">Все статьи
          <!-- CREATE -->
          <a href="/dashboard/article/create/">
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

    @if (count($articles) > 0)
    <table class="table table-striped">

        <thead>
            <th>Заголовок</th>
            <th>Категория</th>
            <th>Доступ</th>
            <th>Создал</th>
            <th>Дата обновления</th>
            <th>Действия</th>
        </thead>

        <tbody>
            @foreach ($articles as $article)
            <tr>
                <td>
                  @if ($article->id==$startPageId)
                  <i class="fa fa-home" aria-hidden="true"></i>
                  @endif

                  <?php $type = (explode("-",$article->category->slug)) ?>

                  @if (count($type)==3 && $type[0]=='clubcode' && ($type[2]=='info' || $type[2]=='news'))
                    <a href="/club/id/{{$type[1]}}/{{$type[2]}}/id/{{$article->id}}">{{ $article->title }}</a>
                  @else
                    <a href="/article/id/{{ $article->id }}">{{ $article->title }}</a>
                  @endif

                </td>
                <td>{{ $article->category->name }}</td>
                <td>{{ $article->role->title }}</td>
                <td>{{ $article->user->name }}</td>
                <td>{{ $article->updated_at->format('d/m/Y h:m:s') }}</td>
                <td>

                  @if ($article->category->club==false)
                  <p>
                    <!-- EDIT -->
                    <a href="/dashboard/article/edit/id/{{ $article->id }}">
                      <button type="button" class="btn btn-primary btn-sm">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                      </button>
                    </a>


                  @if ($article->id!=$startPageId)

                    <!-- setStartPage -->
                    <a href="/dashboard/setting/startpage/{{ $article->id }}">
                      <a class="btn btn-default btn-sm" href="/dashboard/setting/startpage/{{ $article->id }}"
                          onclick="event.preventDefault();
                                   document.getElementById('setStartPage-form{{ $article->id }}').submit();">
                                   <i class="fa fa-home" aria-hidden="true"></i>
                      </a>
                    </a>

                    <!-- DELETE -->
                    <a href="/dashboard/article/delete/id/{{ $article->id }}">
                      <a class="btn btn-danger btn-sm" href="/dashboard/article/{{ $article->id }}"
                          onclick="event.preventDefault();
                                   document.getElementById('destroy-form{{ $article->id }}').submit();">
                                   <i class="fa fa-trash" aria-hidden="true"></i>
                      </a>
                    </a>

                    <form id="setStartPage-form{{ $article->id }}" action="/dashboard/setting/startpage/{{ $article->id }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        <input type="hidden" name="type" value="article">
                    </form>

                      <form id="destroy-form{{ $article->id }}" action="/dashboard/article/{{ $article->id }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                      </form>


                @endif
                  </p>
                @endif

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $articles->links() }}
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
        url: '/dashboard/article/search',
        data: {keyword: $('#searchInput').val()},
        success: function (result) {
          if (result.length>0) {
            $.each(result, function(index,value) {
              $('#searchTableBody').append('\
              <tr>\
                <td><a href="/article/id/'+value['id']+'">'+value['title']+'</a></td>\
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
